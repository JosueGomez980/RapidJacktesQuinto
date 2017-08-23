<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidoEntrega
 *
 * @author Josué Francisco
 */
include_once 'EntityDTO.php';

final class PedidoEntregaDTO implements EntityDTO{

    private $facturaIdFactura;
    private $cuentaTipoDocumento;
    private $cuentaNumDocumento;
    private $domicilio;
    private $fechaSolicitud;
    private $fechaEntrega;
    private $estado;
    private $observaciones;
    private $subtotal;
    private $impuestos;
    private $total;

    public function __construct() {
        
    }

    public function getFacturaIdFactura() {
        return $this->facturaIdFactura;
    }

    public function getCuentaTipoDocumento() {
        return $this->cuentaTipoDocumento;
    }

    public function getCuentaNumDocumento() {
        return $this->cuentaNumDocumento;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

    public function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getImpuestos() {
        return $this->impuestos;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setFacturaIdFactura($facturaIdFactura) {
        $this->facturaIdFactura = (string) $facturaIdFactura;
    }

    public function setCuentaTipoDocumento($cuentaTipoDocumento) {
        $this->cuentaTipoDocumento = (string) $cuentaTipoDocumento;
    }

    public function setCuentaNumDocumento($cuentaNumDocumento) {
        $this->cuentaNumDocumento = (string) $cuentaNumDocumento;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = (string) $domicilio;
    }

    public function setFechaSolicitud($fechaSolicitud) {
        $this->fechaSolicitud = (string) $fechaSolicitud;
    }

    public function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = (string) $fechaEntrega;
    }

    public function setEstado($estado) {
        $this->estado = (string) $estado;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = (string) $observaciones;
    }

    public function setSubtotal($subtotal) {
        $this->subtotal = (double) $subtotal;
    }

    public function setImpuestos($impuestos) {
        $this->impuestos = (double) $impuestos;
    }

    public function setTotal($total) {
        $this->total = (double) $total;
    }

}
