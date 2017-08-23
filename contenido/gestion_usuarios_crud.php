<?php
include_once 'includes/ContenidoPagina.php';
include_once 'cargar_clases.php';
AutoCarga::init();
$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$sesion = SimpleSession::getInstancia();
$sesion instanceof SimpleSession;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);
?>

<!DOCTYPE html>

<html>

<?php
$pageContent = ContenidoPagina::getInstancia();
$pageContent instanceof ContenidoPagina;
$pageContent->getHead2();
?>
    <body>
    <?php
    $pageContent->getHeader2();
    if ($sesion->existe(Session::NEGOCIO_RTA)) {
        $modal = $sesion->getEntidad(Session::NEGOCIO_RTA);
        $modal instanceof ModalSimple;
        $modal->open();
        $modal->maquetar();
        $modal->close();
        $sesion->removeEntidad(Session::NEGOCIO_RTA);
    }
    ?>
        <section class="m-section">
            
        </section>  
<?php
$pageContent->getFooter2();
?>
    </body>

</html>


