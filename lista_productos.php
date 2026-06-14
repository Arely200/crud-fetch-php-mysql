<?php
header("Content-Type: application/json");
require_once 'Modelo/Productos.php';

$producto = new Producto();
$productos = $producto->listarTodos();

echo json_encode($productos);
exit;
?>