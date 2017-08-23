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

    $pageContent = ContenidoPagina::getInstancia();
    $pageContent->getHead();

    AutoCarga::init();
    $userManager = new UsuarioController();
    $proMQT = new ProductoMaquetador();
    $categManager = new ProductoController();
    ?>
    <body>
        <?php
        $pageContent->getHeader();
        $userManager->mostrarManagerLink();
        ?>
        <div id="CARRITO"></div>
        <section class="m-section">
            <div class="w3-row">
                <div class="w3-container w3-half w3-light-grey">
                    <h4 class="w3-center">Buscar por...</h4> 
                    <label for="cuenta_tip_doc" class="labels">Categoría</label>
                    <?php
                    $proMQT->maquetaCategoriasForUser();
                    ?>
                </div>
            </div>
            <hr class="w3-lime w3-padding-4">
            <div id="RTA" class="w3-center">
                <?php
                    $categManager->listarPorDefecto();
                ?>
            </div>
        </section>
        <?php
        $pageContent->getFooter();
        ?>
    </body>
</html>
