<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoDAO
 *
 * @author Josué Francisco
 */
include_once("ProductoDTO.php.");
include_once("Conexion.php");
include_once("PreparedSQL.php");

final class ProductoDAO implements DAOPaginable{

    private $db;
    private static $idProducto = "ID_PRODUCTO";
    private static $idCategoria = "CATEGORIA_ID_CATEGORIA";
    private static $idCatalogo = "CATALOGO_ID_CATALOGO";
    private static $nombre = "NOMBRE";
    private static $precio = "PRECIO";
    private static $activo = "ACTIVO";
    private static $cantidad = "CANTIDAD";
    private static $descripcion = "DESCRIPCION";
    private static $foto = "FOTO";
    public static $instacia = NULL;

    public function __construct() {
        $this->db = Conexion::getInstance();
    }

    public static function getInstancia() {
        if (is_null(self::$instacia)) {
            self::$instacia = new ProductoDAO();
        }
        return self::$instacia;
    }

    private function resultToObject(mysqli_result $resultado) {
        $fila = $resultado->fetch_array();
        $producto = new ProductoDTO();
        $producto->setIdProducto($fila[self::$idProducto]);
        $producto->setCategoriaIdCategoria($fila[self::$idCategoria]);
        $producto->setCatalogoIdCatalogo($fila[self::$idCatalogo]);
        $producto->setNombre($fila[self::$nombre]);
        $producto->setPrecio($fila[self::$precio]);
        $producto->setActivo($fila[self::$activo]);
        $producto->setCantidad($fila[self::$cantidad]);
        $producto->setDescripcion($fila[self::$descripcion]);
        $producto->setFoto($fila[self::$foto]);
        return $producto;
    }

    private function resultToArray(mysqli_result $resultado) {
        $produtos = array();
        while ($fila = $resultado->fetch_array()) {
            $producto = new ProductoDTO();
            $producto->setIdProducto($fila[self::$idProducto]);
            $producto->setCategoriaIdCategoria($fila[self::$idCategoria]);
            $producto->setCatalogoIdCatalogo($fila[self::$idCatalogo]);
            $producto->setNombre($fila[self::$nombre]);
            $producto->setPrecio($fila[self::$precio]);
            $producto->setActivo($fila[self::$activo]);
            $producto->setCantidad($fila[self::$cantidad]);
            $producto->setDescripcion($fila[self::$descripcion]);
            $producto->setFoto($fila[self::$foto]);
            $produtos[] = $producto;
        }
        return $produtos;
    }

    public function insert(ProductoDTO $proInsert) {
        $idPro = $proInsert->getIdProducto();
        $categoria = $proInsert->getCategoriaIdCategoria();
        $catalogo = $proInsert->getCatalogoIdCatalogo();
        $nombre = $proInsert->getNombre();
        $precio = $proInsert->getPrecio();
        $cantidad = $proInsert->getCantidad();
        $descripcion = $proInsert->getDescripcion();
        $foto = $proInsert->getFoto();
        $res = 0;
        if (is_null($foto) || empty($foto)) {
            $foto = "SIN_ASIGNAR";
        }
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_insert);
            $stmt->bind_param("siisdiss", $idPro, $categoria, $catalogo, $nombre, $precio, $cantidad, $descripcion, $foto);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return($res);
    }

    public function update(ProductoDTO $proUpdate) {
        $idPro = $proUpdate->getIdProducto();
        $categoria = $proUpdate->getCategoriaIdCategoria();
        $catalogo = $proUpdate->getCatalogoIdCatalogo();
        $nombre = $proUpdate->getNombre();
        $precio = $proUpdate->getPrecio();
        $descripcion = $proUpdate->getDescripcion();
        $foto = $proUpdate->getFoto();
        if (is_null($foto) || $foto == "") {
            $foto = "SIN_ASIGNAR";
        }
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_update);
            $stmt->bind_param("iisdsss", $categoria, $catalogo, $nombre, $precio, $descripcion, $foto, $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $res;
    }
    
    public function updateCantidad(ProductoDTO $proUpdate){
        $idPro = $proUpdate->getIdProducto();
        $cantidad = $proUpdate->getCantidad();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_update_ctd);
            $stmt->bind_param("is", $cantidad, $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $res;
    }

    public function delete(ProductoDTO $proDelete) {
        $idPro = $proDelete->getIdProducto();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_delete);
            $stmt->bind_param("s", $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getTraceAsString;
        }
        return $res;
    }

    public function disable_enable(ProductoDTO $producto, $yn) {
        $idPro = $producto->getIdProducto();
        $res = 0;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_enable_disable);
            $stmt->bind_param("is", $yn, $idPro);
            $stmt->execute();
            $res = $stmt->affected_rows;

            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getTraceAsString;
        }
        return $res;
    }

    public function find(ProductoDTO $proFind) {
        $idPro = $proFind->getIdProducto();
        $producto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_find);
            $stmt->bind_param("s", $idPro);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $producto = $this->resultToObject($resultado);
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $producto;
    }

    public function findAll() {
        $tablaProducto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $resultado = $conexion->query(PreparedSQL::producto_find_all);
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $tablaProducto = $this->resultToArray($resultado);
            }
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
        return $tablaProducto;
    }

    public function findByCategoria(ProductoDTO $proFind) {
        $categoria = $proFind->getCategoriaIdCategoria();
        $tablaProducto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_find_by_categoria);
            $stmt->bind_param("i", $categoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $tablaProducto = $this->resultToArray($resultado);
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $tablaProducto;
    }

    public function findByFK(ProductoDTO $proFind) {
        $categoria = $proFind->getCategoriaIdCategoria();
        $catalogo = $proFind->getCatalogoIdCatalogo();
        $tablaProducto = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $stmt = $conexion->prepare(PreparedSQL::producto_find_by_fk);
            $stmt->bind_param("ii", $catalogo, $categoria);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $resultado instanceof mysqli_result;
            if ($resultado->num_rows != 0) {
                $tablaProducto = $this->resultToArray($resultado);
            }
            $stmt->close();
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $tablaProducto;
    }

    public function findByRandom($limite) {
        $tablaProductos = array();
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $rst1 = $conexion->query("SELECT COUNT(*) AS '#PRO' FROM PRODUCTO;");
            $rst1 instanceof mysqli_result;
            $nPro = $rst1->fetch_array()['#PRO'];
            $productos = $this->findAll();
            for ($i = 0; $i < $limite; $i++) {
                $ind = rand(1, $nPro - 1);
                $tablaProductos[$i] = $productos[$ind];
            }
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $tablaProductos;
    }

    public function findByNameLike($nombre) {
        
    }

    public function findByPrecio($precio) {
        
    }

    public function findByPrecioRango($precioFrom, $precioTo) {
        
    }

    public function findByPrecioAsc() {
        
    }

    public function findByPrecioDesc() {
        
    }

    public function generateIdInCore() {
        $getNPro = "SELECT COUNT(p.ID_PRODUCTO) AS 'NPRO' FROM PRODUCTO p;";
        $newId = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $resultado = $conexion->query($getNPro);
            $nProductos = (int) $resultado->fetch_array()["NPRO"];
            $zeros = 7 - (strlen($nProductos + 1));
            $newId = "pro";
            $newId .= str_repeat("0", $zeros);
            $newId .= ($nProductos + 1);
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $newId;
    }

    public function generateIdInDB() {
        $newId = NULL;
        try {
            $conexion = $this->db->creaConexion();
            $conexion instanceof mysqli;
            $resultado = $conexion->query(PreparedSQL::get_new_producto_id);
            $newId = $resultado->fetch_array()["NEW_ID"];
            $resultado->close();
            $conexion->close();
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
        }
        return $newId;
    }

    public function generateProductoImageUrl() {
        $idPro = $this->generateIdInDB();
        $finalName = "pro_img_" . $idPro;
        return $finalName;
    }
    
    public function findByPaginationLimit($inicio, $cantidad){
        
    }

}
