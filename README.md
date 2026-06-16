# Laboratorio CRUD de Productos con PHP MVC, Fetch API y MySQL

**Desarrollo de Software VII**
**Universidad Tecnológica de Panamá (UTP)**

---

# Descripción General

Este proyecto implementa un sistema CRUD (Create, Read, Update y Delete) para la administración de productos utilizando la arquitectura MVC (Modelo - Vista - Controlador).

La aplicación permite registrar, consultar, modificar y eliminar productos almacenados en una base de datos MySQL. La comunicación entre la interfaz y el servidor se realiza mediante Fetch API, permitiendo una experiencia dinámica sin necesidad de recargar la página.

---

# Objetivos del Proyecto

* Aplicar el patrón de arquitectura MVC.
* Implementar Programación Orientada a Objetos (POO) en PHP.
* Utilizar MySQL para la persistencia de datos.
* Realizar operaciones CRUD completas.
* Implementar validaciones tanto en cliente como en servidor.
* Utilizar Fetch API para la comunicación asíncrona.
* Mejorar la experiencia del usuario mediante alertas interactivas.

---

# Tecnologías Utilizadas

| Tecnología  | Descripción                        |
| ----------- | ---------------------------------- |
| HTML5       | Estructura de la interfaz          |
| CSS3        | Diseño y estilos                   |
| Bootstrap 5 | Diseño responsivo                  |
| JavaScript  | Lógica del cliente                 |
| Fetch API   | Peticiones asíncronas              |
| SweetAlert2 | Mensajes interactivos              |
| PHP 8       | Backend orientado a objetos        |
| MySQL       | Base de datos                      |
| PDO         | Conexión segura a la base de datos |

---

# Estructura del Proyecto

```text
crud_productos/
│
├── assets/
│   ├── css/
│   │   └── estilo.css
│   └── js/
│       └── script.js
│
├── controllers/
│   ├── ProductoController.php
│   └── ListarController.php
│
├── models/
│   ├── conexion.php
│   └── Productos.php
│
├── views/
│   └── index.html
│
├── productos.sql
└── README.md
```

---

# Descripción de Componentes

## Modelo

### Productos.php

Contiene la lógica de negocio relacionada con los productos:

* Guardar productos.
* Buscar productos por código.
* Modificar productos.
* Eliminar productos.
* Validar datos.
* Verificar códigos duplicados.

### conexion.php

Administra la conexión a MySQL utilizando PDO.

---

## Controladores

### ProductoController.php

Recibe las solicitudes enviadas desde la interfaz y ejecuta las acciones correspondientes:

* Guardar
* Buscar
* Modificar
* Eliminar

Devuelve respuestas en formato JSON.

### ListarController.php

Obtiene todos los productos registrados para mostrarlos en la tabla principal.

---

## Vista

### index.html

Interfaz principal del sistema.

Permite:

* Registrar productos.
* Buscar productos.
* Modificar productos.
* Eliminar productos.
* Visualizar el listado completo.

---

# Base de Datos

## Nombre de la Base de Datos

```sql
productos
```

## Tabla Principal

```sql
productos
```

### Campos

| Campo    | Tipo          |
| -------- | ------------- |
| id       | INT           |
| codigo   | VARCHAR(20)   |
| producto | VARCHAR(100)  |
| precio   | DECIMAL(10,2) |
| cantidad | INT           |

---

# Instalación del Proyecto

## 1. Copiar el proyecto

Copiar la carpeta del proyecto dentro del directorio de WAMP:

```text
C:\wamp64\www\crud_productos
```

---

## 2. Crear la base de datos

Abrir phpMyAdmin e importar el archivo:

```text
productos.sql
```

o ejecutar:

```sql
source C:/wamp64/www/crud_productos/productos.sql
```

---

## 3. Configurar conexión

Editar el archivo:

```text
models/conexion.php
```

y establecer las credenciales de MySQL:

```php
$host = "localhost";
$dbname = "productos";
$user = "root";
$password = "";
```

---

## 4. Iniciar el servidor

Abrir WAMP Server y verificar que Apache y MySQL estén activos.

---

## 5. Ejecutar la aplicación

Abrir en el navegador:

```text
http://localhost/crud_productos/views/index.html
```

---

# Funcionalidades Implementadas

## Crear Producto

Permite registrar nuevos productos.

### Validaciones

* Código obligatorio.
* Nombre obligatorio.
* Precio mayor que cero.
* Cantidad mínima de 1.
* Código único.

---

## Buscar Producto

Permite localizar un producto utilizando su código.

---

## Modificar Producto

Permite actualizar:

* Código.
* Nombre.
* Precio.
* Cantidad.

### Validaciones

* No permite cantidades negativas.
* No permite códigos repetidos.

---

## Eliminar Producto

Permite eliminar registros existentes desde la tabla.

---

## Listar Productos

Muestra todos los productos registrados en una tabla dinámica.

---

# Validaciones Implementadas

## Cliente (JavaScript)

* Campos obligatorios.
* Validación de cantidades.
* Validación de precios.

## Servidor (PHP)

* Código único.
* Cantidad válida.
* Precio válido.
* Nombre obligatorio.

---

# Resultados Esperados

El sistema debe permitir gestionar correctamente un inventario de productos realizando operaciones CRUD completas mediante una interfaz amigable y validaciones seguras tanto en cliente como en servidor.

---

# Conclusión

Este laboratorio permitió aplicar los conceptos fundamentales de Desarrollo Web utilizando PHP Orientado a Objetos, MySQL, arquitectura MVC y Fetch API. Además, se reforzó la implementación de validaciones, manipulación de bases de datos y desarrollo de aplicaciones dinámicas bajo un entorno cliente-servidor.
