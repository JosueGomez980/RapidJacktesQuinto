<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioMaquetador
 *
 * @author SOPORTE
 */
class UsuarioMaquetador implements GenericMaquetador {
    //Metodo reservado para maquetar la tabla de crud de usuarios. (Solo accesible por el administrador)
    public function maquetaArrayObject(array $entidades) {
        echo("");
    }

    public function maquetaObject(EntityDTO $entidad) {
        $entidad instanceof UsuarioDTO;
        $id = $entidad->getIdUsuario();
        $rol = $entidad->getRol();
        $estado = $entidad->getEstado();
        $email = $entidad->getEmail();
        $salida = '<div class="w3-row">
                <div class="w3-container w3-half w3-card-8 w3-theme-d3 w3-padding-32">
                    <img class="m-simple-user-img" src="../media/img/icons_users/man-user.png">
                    <ul class="w3-ul w3-border-bottom">
                        <li><span class="w3-large">ID del Usuario</span><br><span class="m-text-sub1">' . $id . '</span></li>
                        <li><span class="w3-large">ROL</span><br><span class="m-text-sub1">' . $rol . '</span></li>
                        <li><span class="w3-large">ESTADO</span><br><span class="m-text-sub1">' . $estado . '</span></li>
                        <li><span class="w3-large">EMAIL</span><br><span class="m-text-sub1">' . $email . '</span></li>
                    </ul>
                </div>
            </div>';
        echo($salida);
    }

    public function maquetaCardSesion(UsuarioDTO $user, CuentaDTO $cuenta) {
        $idUser = Validador::fixTexto($user->getIdUsuario());
        $nombre = Validador::fixTexto($cuenta->getPrimerNombre());
        $apellido = Validador::fixTexto($cuenta->getPrimerApellido());
        $nombres = $nombre . " " . $apellido;
        $salida = '<hr><div class="w3-row">
                <div class="w3-container w3-theme-d2 w3-half w3-right">
                    <div class="w3-row">
                        <div class="w3-quarter">
                            <img class="m-user-in-sesion-img" src="../media/img/icons_users/man-user.png">
                        </div>
                        <div class="w3-theme-l5 w3-container w3-threequarter">
                            <ul class="w3-ul w3-tiny">
                                <li><span class="w3-text-theme">NOMBRE: <b>' . $nombres . '</b></span></li>
                                <li><span class="w3-text-theme">TU USERNAME: <b>' . $idUser . '</b></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="w3-right w3-container w3-padding-4 w3-card-2">
                        <a href="controlador/negocio/unlog.php"><button class="w3-btn w3-blue w3-tiny w3-text-white w3-round-large m-c-v">Salir<img class="m-user-admin-icons" src="../media/img/icons_users/logout.png" ></button></a>
                        <a href="configurar_cuenta.php"><button class="w3-btn w3-blue w3-tiny w3-text-white w3-round-large m-c-v">Configuración<img class="m-user-admin-icons" src="../media/img/icons_users/config_cuenta.png" ></button></a>
                    </div>
                </div>
            </div>';
        echo($salida);
    }
    public function maquetarManagerLink($userName){
        echo('<div class="m-manager-tools w3-col l3 m5 s12 w3-container w3-animate-right">
                <img src="../media/img/icons_users/man-with-sunglasses-and-suit.png" style="width: 25px; height: auto; margin: auto;">
                <span class="w3-small w3-text-green">Bienvenido '.$userName.' (Administrador)</span><br>
                <a href="admin_panel.php" target="_blank"><button class="w3-btn w3-green w3-round-xlarge w3-tiny">IR A PANEL DE ADMINISTRADOR</button></a>
                <a href="controlador/negocio/unlog.php"><button class="w3-btn w3-green w3-round-xlarge w3-tiny">SALIR</button></a>
            </div>');
    }
}
