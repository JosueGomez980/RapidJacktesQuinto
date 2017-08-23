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
    $acceso = AccesoPagina::getInstacia();
    $acceso instanceof AccesoPagina;
    $categManager = new ProductoController();
    if (!isset($_GET[ProductoRequest::pro_id])) {
        $acceso->irPagina(AccesoPagina::INICIO);
    }
    $proDAO = ProductoDAO::getInstancia();
    $proDAO instanceof ProductoDAO;
    $productoRequest = new ProductoRequest();
    $productoGet = $productoRequest->getProductoDTO();
    $productoGet instanceof ProductoDTO;
    $productoGet->setIdProducto(CriptManager::urlVarDecript($productoGet->getIdProducto()));

    $proFinded = $proDAO->find($productoGet);
    ?>
    <body>
        <?php
        $pageContent->getHeader();
        ?>
        <div id="CARRITO"></div>
        <section class="m-section">
            <?php
            if (!is_null($proFinded)) {
                $categManager->encontrar($proFinded);
            } else {
                $msg = new Neutral();
                $msg->setValor("No se encontrón ningún producto :(");
                echo($msg->toString($msg->getValor()));
            }
            ?>
        </section>
        
        <?php
        $pageContent->getFooter();
        ?>
    </body>
</html>
