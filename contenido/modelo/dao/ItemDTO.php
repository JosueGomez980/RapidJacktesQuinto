<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemFactura
 *
 * @author Josué Francisco
 */
include_once 'EntityDTO.php';

final class ItemDTO implements EntityDTO {

    private $productoIdProducto;
    private $facturaIdFactura;
    private $cantidad;
    private $costoUnitario;
    private $costoTotal;

    public function __construct() {
        
    }

    public function getProductoIdProducto() {
        return $this->productoIdProducto;
    }

    public function getFacturaIdFactura() {
        return $this->facturaIdFactura;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getCostoUnitario() {
        return $this->costoUnitario;
    }

    public function getCostoTotal() {
        return $this->costoTotal;
    }

    public function setProductoIdProducto($productoIdProducto) {
        $this->productoIdProducto = (string) $productoIdProducto;
    }

    public function setFacturaIdFactura($facturaIdFactura) {
        $this->facturaIdFactura = (string) $facturaIdFactura;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = (int) $cantidad;
    }

    public function setCostoUnitario($costoUnitario) {
        $this->costoUnitario = (double) $costoUnitario;
    }

    public function setCostoTotal($costoTotal) {
        $this->costoTotal = (double) $costoTotal;
    }

}
