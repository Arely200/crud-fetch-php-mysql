// Variable para almacenar el ID del producto a editar
let productoId = null;

// Función para listar todos los productos
async function listarProductos() {
    try {
        const response = await fetch('lista_productos.php');
        const productos = await response.json();
        
        const tbody = document.getElementById('tablaProductos');
        if(productos.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">No hay productos registrados</td></tr>';
            return;
        }
        
        tbody.innerHTML = productos.map(producto => `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.codigo}</td>
                <td>${producto.producto}</td>
                <td>${producto.precio}</td>
                <td>${producto.cantidad}</td>
            </tr>
        `).join('');
    } catch(error) {
        console.error('Error al listar productos:', error);
    }
}

// Función para limpiar el formulario
function limpiarFormulario() {
    document.getElementById('productoId').value = '';
    document.getElementById('codigo').value = '';
    document.getElementById('producto').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('cantidad').value = '';
    productoId = null;
    document.getElementById('cantidad').min = '1';
}

// Función para enviar datos al servidor
async function enviarDatos(accion, data) {
    data.append('accion', accion);
    
    try {
        const response = await fetch('registrar.php', {
            method: 'POST',
            body: data
        });
        
        const result = await response.json();
        
        if(result.success) {
            await Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: result.message,
                confirmButtonColor: '#28a745'
            });
            limpiarFormulario();
            listarProductos();
        } else {
            if(result.errors) {
                let mensajeError = '';
                for(let campo in result.errors) {
                    mensajeError += result.errors[campo] + '\n';
                }
                await Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: mensajeError,
                    confirmButtonColor: '#dc3545'
                });
            } else {
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: result.message,
                    confirmButtonColor: '#dc3545'
                });
            }
        }
    } catch(error) {
        console.error('Error:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo conectar con el servidor',
            confirmButtonColor: '#dc3545'
        });
    }
}

// Evento Guardar
document.getElementById('btnGuardar').addEventListener('click', () => {
    const form = document.getElementById('productoForm');
    const formData = new FormData(form);
    enviarDatos('Guardar', formData);
});

// Evento Modificar
document.getElementById('btnModificar').addEventListener('click', () => {
    const productoId = document.getElementById('productoId').value;
    if(!productoId) {
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Primero busque un producto para modificar',
            confirmButtonColor: '#ffc107'
        });
        return;
    }
    
    const form = document.getElementById('productoForm');
    const formData = new FormData(form);
    enviarDatos('Modificar', formData);
});

// Evento Buscar
document.getElementById('btnBuscar').addEventListener('click', async () => {
    const codigo = document.getElementById('codigo').value;
    
    if(!codigo) {
        await Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Ingrese el código del producto a buscar',
            confirmButtonColor: '#ffc107'
        });
        return;
    }
    
    const formData = new FormData();
    formData.append('codigo', codigo);
    formData.append('accion', 'Buscar');
    
    try {
        const response = await fetch('registrar.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if(result.success) {
            document.getElementById('productoId').value = result.data.id;
            document.getElementById('codigo').value = result.data.codigo;
            document.getElementById('producto').value = result.data.producto;
            document.getElementById('precio').value = result.data.precio;
            document.getElementById('cantidad').value = result.data.cantidad;
            productoId = result.data.id;
            
            document.getElementById('cantidad').min = '0';
            
            await Swal.fire({
                icon: 'success',
                title: 'Producto encontrado',
                text: 'Puede modificar los datos',
                confirmButtonColor: '#28a745'
            });
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'No encontrado',
                text: result.message,
                confirmButtonColor: '#dc3545'
            });
            limpiarFormulario();
        }
    } catch(error) {
        console.error('Error:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al buscar el producto',
            confirmButtonColor: '#dc3545'
        });
    }
});

// Evento Limpiar
document.getElementById('btnLimpiar').addEventListener('click', () => {
    limpiarFormulario();
});

// Cargar la lista de productos al iniciar
document.addEventListener('DOMContentLoaded', () => {
    listarProductos();
});