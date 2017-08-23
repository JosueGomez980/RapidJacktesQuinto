<?php
include_once 'includes/ContenidoPagina.php';
include_once 'cargar_clases.php';

AutoCarga::init();
$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <?php
    $pageContent = ContenidoPagina::getInstancia();
    $pageContent instanceof ContenidoPagina;
    $pageContent->getHead2();
    ?>
    <body>
        <?php
        $pageContent->getHeader2();
        ?>
        <section class="m-section">
            <?php
            ?>
        </section>
        <?php
        $pageContent->getFooter2();
        ?>
    </body>
</html>

