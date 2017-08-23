<?php

include_once 'cargar_clases2.php';
AutoCarga2::init();
$sesion = SimpleSession::getInstancia();
$sesion instanceof SimpleSession;

$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);

$tablaCategoriasPaginada = NULL;
//Validar que se ha enviado el formulario
if (!isset($_GET["page"])) {
    $acceso->irPagina(AccesoPagina::NEG_TO_ADM_PN_GST_PRO);
}
//Validar que la instancia del paginador esté cargada en memoria
if (!$sesion->existe(Session::PAGINADOR)) {
    $acceso->irPagina(AccesoPagina::NEG_TO_ADM_PN_GST_PRO);
}

$paginaRequest = filter_input(INPUT_GET, "page");

$paginador = $sesion->getEntidad(Session::PAGINADOR);
$paginador instanceof PaginadorMemoria;

if (Validador::validaInteger($paginaRequest)) {
    $paginaRequest = (int) $paginaRequest;
    if ($paginaRequest <= $paginador->getNumeroPaginas()) {
        $tablaCategoriasPaginada = $paginador->getPage($paginaRequest);
    } else {
        $tablaCategoriasPaginada = $paginador->getTablaActual();
    }
} else {
    switch ($paginaRequest) {
        case "NEXT":
            $tablaCategoriasPaginada = $paginador->nextPage();
            break;
        case "PREV":
            $tablaCategoriasPaginada = $paginador->prevPage();
            break;
        case "LAST":
            $tablaCategoriasPaginada = $paginador->lastPage();
            break;
        case "FIRST":
            $tablaCategoriasPaginada = $paginador->firstPage();
            break;
        default :
            $tablaCategoriasPaginada = $paginador->getTablaActual();
            break;
    }
}
$categManager = new CategoriaController();
$sesion->add(Session::PAGINADOR, $paginador);

$categManager->mostrarCategoriasCrudTable($tablaCategoriasPaginada);
