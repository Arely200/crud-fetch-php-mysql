<?php
require_once 'conexion.php';

class Producto {
    private $db;
    private $codigo;
    private $producto;
    private $precio;
    private $cantidad;
    private $errores = [];

    public function __construct() {
        $this->db = new DB();
    }

    public function setCodigo($codigo) {
        $this->codigo = trim($codigo);
    }

    public function setProducto($producto) {
        $this->producto = trim($producto);
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function validar($esNuevo = true) {
        $this->errores = [];
        
        if(empty($this->codigo)) {
            $this->errores['codigo'] = 'El código es obligatorio';
        }
        
        if(empty($this->producto)) {
            $this->errores['producto'] = 'El nombre del producto es obligatorio';
        }
        
        if($this->precio === '' || $this->precio === null || $this->precio <= 0) {
            $this->errores['precio'] = 'El precio debe ser mayor a 0';
        }
        
        if($esNuevo) {
            if($this->cantidad === '' || $this->cantidad === null || $this->cantidad < 1) {
                $this->errores['cantidad'] = 'Para un producto nuevo, la cantidad debe ser al menos 1';
            }
        } else {
            if($this->cantidad === '' || $this->cantidad === null || $this->cantidad < 0) {
                $this->errores['cantidad'] = 'La cantidad no puede ser negativa';
            }
        }
        
        return empty($this->errores);
    }

    public function getErrores() {
        return $this->errores;
    }

    public function guardar() {
        if(!$this->validar(true)) {
            return ['success' => false, 'errors' => $this->errores, 'accion' => 'Guardar'];
        }
        
        $sql = "INSERT INTO productos (codigo, producto, precio, cantidad) VALUES (?, ?, ?, ?)";
        $result = $this->db->executeQuery($sql, [$this->codigo, $this->producto, $this->precio, $this->cantidad]);
        
        if($result) {
            return ['success' => true, 'message' => 'Producto guardado correctamente', 'accion' => 'Guardar'];
        } else {
            return ['success' => false, 'message' => 'Error al guardar el producto', 'accion' => 'Guardar'];
        }
    }

    public function editar($id) {
        if(!$this->validar(false)) {
            return ['success' => false, 'errors' => $this->errores, 'accion' => 'Modificar'];
        }
        
        $sql = "UPDATE productos SET codigo = ?, producto = ?, precio = ?, cantidad = ? WHERE id = ?";
        $result = $this->db->executeQuery($sql, [$this->codigo, $this->producto, $this->precio, $this->cantidad, $id]);
        
        if($result) {
            return ['success' => true, 'message' => 'Producto actualizado correctamente', 'accion' => 'Modificar'];
        } else {
            return ['success' => false, 'message' => 'Error al actualizar el producto', 'accion' => 'Modificar'];
        }
    }

    public function buscarPorCodigo($codigo) {
        $sql = "SELECT * FROM productos WHERE codigo = ?";
        $result = $this->db->getOne($sql, [$codigo]);
        return $result ? $result : null;
    }

    public function listarTodos() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        return $this->db->getAll($sql);
    }
}
?>