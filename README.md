# Laboratorio CRUD con Fetch, PHP OOP y MySQL — UTP
**Desarrollo de Software VII | Ing. Irina Fong**
**Grupo:** IGS131/IGS132/IGS133 | **Fecha:** Junio 2026

---

## Estructura del Proyecto

crud_productos/
│
├── index.php ← Punto de entrada (redirige a views/)
│
├── assets/
│ ├── css/
│ │ └── estilos.css ← Estilos personalizados
│ └── js/
│ └── script.js ← Lógica JS (Fetch + Switch)
│
├── controllers/
│ ├── ProductoController.php ← Controlador: Guardar, Modificar, Buscar, Eliminar
│ └── ListarController.php ← Controlador: Listar productos
│
├── models/
│ ├── conexion.php ← Clase DB (PDO)
│ └── Productos.php ← Clase Producto (CRUD)
│
└── views/
└── index.html ← Vista principal (formulario + tabla)


---

## Instalación Paso a Paso

### 1. Copiar el proyecto a WAMP
Coloca la carpeta `crud_productos` en:
C:\wamp64\www\crud_productos\



### 2. Crear la base de datos
Abre **phpMyAdmin** y ejecuta el siguiente script SQL:

```sql
CREATE DATABASE IF NOT EXISTS productosdb;
USE productosdb;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL,
    producto VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL
);


3. Configurar la conexión a la base de datos
El archivo models/conexion.php contiene las credenciales:

php
private $host = 'localhost';
private $user = 'root';
private $pass = '';           ← actualizar si tiene contraseña
private $dbname = 'productosdb';
4. Ejecutar la aplicación
Abre tu navegador y ve a:

text
http://localhost/crud_productos/
Pruebas de Funcionamiento (CRUD)
GET — Listar todos los productos
text
GET http://localhost/crud_productos/controllers/ListarController.php
Respuesta esperada:

json
[
  {
    "id": 1,
    "codigo": "PR001",
    "producto": "Laptop HP Pavilion",
    "precio": "750.99",
    "cantidad": "10"
  }
]
POST — Guardar producto
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Guardar",
  "codigo": "PR004",
  "producto": "Monitor Samsung 24",
  "precio": 199.99,
  "cantidad": 5
}
Respuesta esperada:

json
{
  "success": true,
  "message": "Producto guardado correctamente",
  "accion": "Guardar"
}
POST — Buscar producto por código
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Buscar",
  "codigo": "PR001"
}
Respuesta esperada:

json
{
  "success": true,
  "data": {
    "id": 1,
    "codigo": "PR001",
    "producto": "Laptop HP Pavilion",
    "precio": "750.99",
    "cantidad": "10"
  },
  "accion": "Buscar"
}
POST — Modificar producto
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Modificar",
  "id": 1,
  "codigo": "PR001",
  "producto": "Laptop HP Pavilion",
  "precio": 800.00,
  "cantidad": 8
}
Respuesta esperada:

json
{
  "success": true,
  "message": "Producto actualizado correctamente",
  "accion": "Modificar"
}
POST — Eliminar producto
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Eliminar",
  "id": 4
}
Respuesta esperada:

json
{
  "success": true,
  "message": "Producto eliminado correctamente",
  "accion": "Eliminar"
}
Escenario Negativo — Código duplicado
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Guardar",
  "codigo": "PR001",
  "producto": "Producto Duplicado",
  "precio": 100.00,
  "cantidad": 1
}
Respuesta esperada:

json
{
  "success": false,
  "errors": {
    "codigo": "El código ya existe. Use un código diferente"
  },
  "accion": "Guardar"
}
Escenario Negativo — Producto no encontrado
text
POST http://localhost/crud_productos/index.php
Content-Type: application/json

{
  "accion": "Buscar",
  "codigo": "XXXXX"
}
Respuesta esperada:

json
{
  "success": false,
  "message": "Producto no encontrado",
  "accion": "Buscar"
}
Reglas de Negocio
Cantidad para productos nuevos
Un producto nuevo debe tener al menos 1 unidad en stock.

Cantidad para editar productos
Al editar, la cantidad puede ser 0 (producto agotado).

Código único
El código del producto debe ser único.

No se permite guardar dos productos con el mismo código.

Tecnologías Utilizadas
Tecnología	Descripción
HTML5	Estructura del formulario y tabla
Bootstrap 5	Diseño responsivo y estilos
JavaScript (Fetch API)	Peticiones asíncronas al servidor
SweetAlert2	Alertas interactivas
PHP 8 (POO)	Lógica del backend
MySQL (PDO)	Base de datos y consultas seguras
WAMP	Servidor local
Actividades Completadas
Actividad	Descripción	Archivo
1	Formulario HTML con envío asíncrono con fetch	views/index.html
2	JavaScript con eventos y Fetch API	assets/js/script.js
3	Clase DB con PDO (conexión segura)	models/conexion.php
4	Clase Producto con CRUD y validaciones	models/Productos.php
5	Controlador con switch centralizado (PHP)	controllers/ProductoController.php
6	Switch en JavaScript para manejar acciones	assets/js/script.js
7	Validaciones en cliente y servidor	models/Productos.php, assets/js/script.js
8	Respuestas JSON con success, message, errors	controllers/ProductoController.php
9	Alertas con SweetAlert2	assets/js/script.js
10	Eliminar producto (punto extra)	models/Productos.php, controllers/ProductoController.php
Autor
Estudiante: Arely
Curso: Desarrollo de Software VII
Instructora: Ing. Irina Fong
Grupo: IGS131/IGS132/IGS133

Enlaces
Repositorio GitHub: https://github.com/Arely200/crud-fetch-php-mysql

Video guía: https://youtu.be/AXZGTOd8ASk

Notas Finales
La aplicación fue desarrollada siguiendo los lineamientos del laboratorio práctico.

Se implementó la funcionalidad de Eliminar como punto extra.

Se utilizó PDO para prevenir inyecciones SQL.

Todas las respuestas del servidor están en formato JSON.

El proyecto utiliza arquitectura MVC con separación clara de responsabilidades.

text
