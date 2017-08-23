<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccesoPagina
 *
 * @author Josué Francisco
 */
final class AccesoPagina {

    public static $instancia = NULL;

    const INICIO = "inicio.php";
    const IN_SESION = "iniciar_sesion.php";
    const PRODUCTOS = "productos.php";
    const ABT_US = "sobre_nosotros.php";
    const US_SIGN_IN = "registro_usuarios.php";
    const CONTC = "contacto.php";
    const NEG_TO_INICIO = "../../inicio.php";
    const NEG_TO_IN_SESION = "../../iniciar_sesion.php";
    const NEG_TO_PRODUCTOS = "../../productos.php";
    const NEG_TO_ABT_US = "../../sobre_nosotros.php";
    const NEG_TO_CONTC = "../../registro_usuarios.php";
    const NEG_TO_CART_GES = "../../gestion_carrito.php";
    const NEG_TO_ADM_PN_GST_PRO = "../../gestion_productos.php";
    const NEG_TO_ADM_PN_GST_CAT = "../../gestion_categorias.php";

    public static function getInstacia() {
        if (is_null(self::$instancia)) {
            self::$instancia = new AccesoPagina();
        }
        return self::$instancia;
    }

    public function comprobarSesion($destino) {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if (!$sesion->existe(Session::US_LOGED)) {
            $this->irPagina($destino);
        }
    }

    public function comprobarSesionAdmin($destino) {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if (!$sesion->existe(Session::US_ADMIN_LOGED) && !$sesion->existe(Session::US_SUB_ADMIN_LOGED)) {
            $this->irPagina($destino);
        }
    }

    public function comprobarSesionMainAdmin($destino) {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if ($sesion->existe(Session::US_ADMIN_LOGED)) {
            $admin = $sesion->getEntidad(Session::US_ADMIN_LOGED);
            $admin instanceof UsuarioDTO;
            if($admin->getRol() !== UsuarioDAO::ROL_MAIN_ADMIN){
                $this->irPagina($destino);
            }
        }else{
            $this->irPagina($destino);
        }
    }

    public function comprobarCarritoInSession() {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if (!$sesion->existe(Session::CART_USER)) {
            $this->irPagina(self::INICIO);
        }
    }

    public function irPagina($pagina) {
        header("Location: " . $pagina);
        exit();
    }
    public static function validaEnviode($varName, $destino){
        if(!isset($_REQUEST[$varName])){
            $this->irPagina($destino);
        }
    }

}
