<?php
header("Content-Type: application/json");
require_once '../models/Productos.php';

$response = [];
$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

// 🔴 SWITCH en PHP como pide la profesora (15 puntos)
switch($accion) {
    case 'Guardar':
        $producto = new Producto();
        $producto->setCodigo($_POST['codigo'] ?? '');
        $producto->setProducto($_POST['producto'] ?? '');
        $producto->setPrecio($_POST['precio'] ?? '');
        $producto->setCantidad($_POST['cantidad'] ?? '');
        
        $response = $producto->guardar();
        break;
        
    case 'Modificar':
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $producto = new Producto();
            $producto->setCodigo($_POST['codigo'] ?? '');
            $producto->setProducto($_POST['producto'] ?? '');
            $producto->setPrecio($_POST['precio'] ?? '');
            $producto->setCantidad($_POST['cantidad'] ?? '');
            
            $response = $producto->editar($_POST['id']);
        } else {
            $response = [
                'success' => false,
                'message' => 'ID de producto no proporcionado',
                'accion' => 'Modificar'
            ];
        }
        break;
        
    case 'Buscar':
        if(isset($_POST['codigo']) && !empty($_POST['codigo'])) {
            $producto = new Producto();
            $productoData = $producto->buscarPorCodigo($_POST['codigo']);
            if($productoData) {
                $response = [
                    'success' => true,
                    'data' => $productoData,
                    'accion' => 'Buscar'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Producto no encontrado',
                    'accion' => 'Buscar'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Ingrese un código para buscar',
                'accion' => 'Buscar'
            ];
        }
        break;
        
    default:
        $response = [
            'success' => false,
            'message' => 'Acción no válida',
            'accion' => ''
        ];
        break;
}

echo json_encode($response);
exit;
?>