<?php

include_once 'cargar_clases2.php';
AutoCarga2::init();

$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);

//Instancia de las clases para manejar los controladores hacia el modelo
$sesion = SimpleSession::getInstancia();
$sesion instanceof SimpleSession;
$productoDAO = ProductoDAO::getInstancia();
$productoDAO instanceof ProductoDAO;
$categManager = new ProductoController();
$productoRequest = new ProductoRequest();
$productoPost = $productoRequest->getProductoDTO();
$productoPost instanceof ProductoDTO;
$proSession = $sesion->getEntidad("PRO_ENABLE_DISABLE");
$proSession instanceof ProductoDTO;
$proDisable = $productoDAO->find($productoPost);
$modal = new ModalSimple();

$modal->open();
if(!is_null($proSession)){
    $categManager->disableEnable($proSession, !$proSession->getActivo());
}else{
    $categManager->disableEnable($proDisable, !$proDisable->getActivo());
}


$closeBtn = new CloseBtn();
$closeBtn->setValor("Aceptar");
$modal->addElemento($closeBtn);

$modal->maquetar();
$modal->close();

$sesion->removeEntidad("PRO_ENABLE_DISABLE");


