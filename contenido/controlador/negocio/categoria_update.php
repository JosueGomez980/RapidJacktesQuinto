<?php

include_once 'cargar_clases2.php';
AutoCarga2::init();

$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);
$sesion = SimpleSession::getInstancia();
$sesion instanceof SimpleSession;
$modal = new ModalSimple();
//Instaciacion de las clases para manajar los DTO's
$categoriaManager = new CategoriaController();
$categoriaRequest = new CategoriaRequest();
$categoriaPost = $categoriaRequest->getCategoriaDTO();
$categoriaPost instanceof CategoriaDTO;

$insertar = TRUE;

//Esta estructura de control se usa para desencriptar la clave foranea de la categoria que es obtenida por atributo 
//value del select de categorias
if (isset($_POST[CategoriaRequest::cat_id_cat])) {
    $categoriaPost->setCategoriaIdCategoria(CriptManager::urlVarDecript(filter_input(INPUT_POST, CategoriaRequest::cat_id_cat)));
}

if (!Validador::validaText($categoriaPost->getNombre(), 5, 150)) {
    $insertar = FALSE;
    $error = new Errado();
    $error->setValor("El nombre de la categoría debe tener mínimo 5 caracteres");
    $modal->addElemento($error);
}
if (!Validador::validaInteger($categoriaPost->getIdCategoria())) {
    $insertar = FALSE;
    $error = new Errado();
    $error->setValor("El id de la categoria debe ser un número entero");
    $modal->addElemento($error);
}
if (!Validador::validaInteger($categoriaPost->getCategoriaIdCategoria())) {
    $insertar = FALSE;
    $error = new Errado();
    $error->setValor("El codigo de la categoría a la que pertenece debe ser un número entero");
    $modal->addElemento($error);
}

if ($insertar) {
    $ok = $categoriaManager->actualizar($categoriaPost);
    if ($ok) {
        $exito = new Exito();
        $exito->setValor("La categoría se modificó correctamente");
        $modal->addElemento($exito);
    } else {
        $error = new Errado();
        $error->setValor("Hubo un error grave al momento de actualizar la categoría.");
        $modal->addElemento($error);
    }
} else {
    $error = new Errado();
    $error->setValor("No se pudo actualizar la categoría, Verifique la información e intente de nuevo");
    $modal->addElemento($error);
}

$closeBtn = new CloseBtn();
$closeBtn->setValor("Aceptar");
$modal->addElemento($closeBtn);

$sesion->add(Session::NEGOCIO_RTA, $modal);
$acceso->irPagina(AccesoPagina::NEG_TO_ADM_PN_GST_CAT);

