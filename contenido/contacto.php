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
    ?>
    <?php
    $pageContent = ContenidoPagina::getInstancia();
    $pageContent->getHead();
    $userManager = new UsuarioController();
    ?>
    <body>
        <?php
        $pageContent->getHeader();
        $userManager->mostrarManagerLink();
        ?>
        <section class="m-section">
            <div id="cardUser">
                <?php
                
                $userManager->mostrarCardUsuario();
                ?>
            </div>
        </section>
        <?php
        $pageContent->getFooter();
        ?>
    </body>
</html>

