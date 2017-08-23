<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDTO
 *
 * @author Josué Francisco
 */
include_once 'EntityDTO.php';

final class UsuarioDTO implements EntityDTO {

    private $idUsuario;
    private $password;
    private $rol;
    private $estado;
    private $email;

    public function __construct() {
        
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = (string) $idUsuario;
    }

    public function setPassword($password) {
        $this->password = (string) $password;
    }

    public function setRol($rol) {
        $this->rol = (string) $rol;
    }

    public function setEstado($estado) {
        $this->estado = (string) $estado;
    }

    public function setEmail($email) {
        $this->email = (string) $email;
    }

}
