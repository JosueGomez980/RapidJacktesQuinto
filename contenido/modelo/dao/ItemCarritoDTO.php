<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemCarrito;
 *
 * @author Josué Francisco
 */
include_once 'EntityDTO.php';

final class ItemCarritoDTO implements EntityDTO {
    
    private $producto = NULL;
    private $productoIdProducto;
    private $carritoIdCarrito;
    private $cantidad;
    private $costoUnitario;
    private $costoTotal;
    private $impuestos;

    public function __construct(ProductoDTO $producto) {
        $this->producto = $producto;
        $this->productoIdProducto = $producto->getIdProducto();
        $this->costoUnitario = $producto->getPrecio();
    }

    public function getProductoIdProducto() {
        return $this->productoIdProducto;
    }

    public function getCarritoIdCarrito() {
        return $this->carritoIdCarrito;
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

    public function getImpuestos() {
        return $this->impuestos;
    }

    public function setProductoIdProducto($productoIdProducto) {
        $this->productoIdProducto = (string) $productoIdProducto;
    }

    public function setCarritoIdCarrito($carritoIdCarrito) {
        $this->carritoIdCarrito = (string) $carritoIdCarrito;
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

    public function setImpuestos($impuestos) {
        $this->impuestos = (double) $impuestos;
    }
    
    public function getProducto() {
        return $this->producto;
    }

    public function setProducto(ProductoDTO $producto) {
        $this->producto = $producto;
    }



}
