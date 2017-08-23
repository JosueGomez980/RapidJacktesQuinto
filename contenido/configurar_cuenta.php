<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    include_once 'includes/ContenidoPagina.php';
    include_once 'cargar_clases.php';

    AutoCarga::init();
    $controlAcceso = AccesoPagina::getInstacia();
    $controlAcceso instanceof AccesoPagina;
    $controlAcceso->comprobarSesion(AccesoPagina::INICIO);

    $pageContent = ContenidoPagina::getInstancia();
    $pageContent->getHead();

    $sesion = SimpleSession::getInstancia();
    $sesion instanceof SimpleSession;
    $user = $sesion->getEntidad(Session::US_LOGED);
    $cuenta = $sesion->getEntidad(Session::CU_LOGED);
    $user instanceof UsuarioDTO;
    $cuenta instanceof CuentaDTO;
    //Obtener los datos que se mostraran en el atributo value de los inputs
    $email = Validador::fixTexto($user->getEmail());
    $primerNombre = Validador::fixTexto($cuenta->getPrimerNombre());
    $segundoNombre = Validador::fixTexto($cuenta->getSegundoNombre());
    $primerApellido = Validador::fixTexto($cuenta->getPrimerApellido());
    $segundoApellido = Validador::fixTexto($cuenta->getSegundoApellido());
    $telefono = $cuenta->getTelefono();
    ?>
    <body>
        <?php
        $pageContent->getHeader();

        // Seccion para mostrar los datos, iconos del usuario que está logeado y el menu 
        ?>
        <section class="m-section">
            <div class="w3-container w3-card-8 w3-theme-d4" id="RTA"></div>
            <div class="w3-container w3-padding-12">
                <div class="w3-btn-group w3-medium">
                    <button onclick="mostrarOcultarTab('informacion_personal')" class="w3-btn w3-ripple w3-orange w3-round-large w3-hover-blue">Cambiar Información Personal</button>
                    <button onclick="mostrarOcultarTab('cambio_contrasena')" class="w3-btn w3-ripple w3-orange w3-round-large w3-hover-blue">Cambiar Contraseña</button>
                </div>

                <div class="w3-row tab w3-animate-top" id="informacion_personal">
                    <form method="POST" name="cambiar_informacion_personal">
                        <h2 class="w3-center">Tu información Personal</h2><hr class="w3-green w3-padding-4">
                        <div class="w3-half w3-container w3-theme-l3">
                            <label class="labels">Primer Nombre</label>
                            <input type="text" class="input_texto" name="cuenta_prim_name" id="cuenta_prim_name" required onblur="valida_simple_input(this)" value="<?php echo($primerNombre); ?>">

                            <label class="labels">Segundo Nombre</label>
                            <input type="text" class="input_texto" name="cuenta_sec_name" id="cuenta_sec_name" required value="<?php echo($segundoNombre); ?>">

                            <label class="labels">Teléfono</label>
                            <input type="text" class="input_texto" name="cuenta_tel" id="cuenta_tel" required onblur="valida_simple_input(this)" value="<?php echo($telefono); ?>">
                        </div>
                        <div class="w3-half w3-container w3-theme-l3">
                            <label class="labels">Primer Apellido</label>
                            <input type="text" class="input_texto" name="cuenta_prim_ape" id="cuenta_prim_ape" required onblur="valida_simple_input(this)" value="<?php echo($primerApellido); ?>">

                            <label class="labels">Segundo Apellido</label>
                            <input type="text" class="input_texto" name="cuenta_sec_ape" id="cuenta_sec_ape" required value="<?php echo($segundoApellido); ?>">

                            <label class="labels">Correo Electrónico</label>
                            <input type="email" class="input_texto" name="user_email" id="user_email" required onblur="valida_user_email()" value="<?php echo($email); ?>">
                            <div><span class="w3-tiny w3-text-red" id="user_email_res"></span></div>
                        </div>  
                    </form>
                    <br><br>
                    <div class="w3-center">
                        <input type="submit" value="Aplicar" class="w3-btn w3-green w3-round-large w3-hover-blue" onclick="cambiarPersonalData()">
                        <a href="inicio.php"><button class="w3-btn w3-red w3-round-large w3-hover-blue">Cancelar</button></a>
                    </div>  
                </div>

                <div class="w3-row w3-hide tab w3-animate-top" id="cambio_contrasena">
                    <form method="POST" id="cambiar_contrasena">
                        <h2 class="w3-center">Cambia Tu Contraseña</h2><hr class="w3-green w3-padding-4">
                        <label for="user_id" class="labels">Contraseña nueva</label>
                        <input type="password" class="input_texto" name="user_password" id="user_passwordA" placeholder="Password" required onkeydown="valida_user_passA()" onblur="valida_user_passA()">
                        <span class="w3-text-red w3-large">*</span>
                        <div><span class="w3-tiny w3-text-red" id="user_passA_res"></span></div>
                        <div><span class="w3-tiny" id="user_passA_res2"></span></div>
                        <br>
                        <label for="user_id" class="labels">Repite la nueva contraseña</label>
                        <input type="password" class="input_texto" name="user_passwordB" id="user_passwordB" placeholder="Password" required onblur="valida_user_passB()" onpaste="avoid_paste()">
                        <span class="w3-text-red w3-large">*</span>
                        <div><span class="w3-tiny" id="user_passB_res"></span></div>
                    </form>
                    <br><br>
                    <div class="w3-center">
                        <input type="submit" value="Aplicar" class="w3-btn w3-green w3-round-large w3-hover-blue" onclick="cambiarPassword()">
                        <a href="inicio.php"><button class="w3-btn w3-red w3-round-large w3-hover-blue">Cancelar</button></a>
                    </div> 
                </div>
            </div>

        </section>
        <?php
        $pageContent->getFooter();
        ?>
    </body>
</html>
