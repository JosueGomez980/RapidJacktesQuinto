<?php
include_once 'includes/ContenidoPagina.php';
include_once 'cargar_clases.php';

AutoCarga::init();
$acceso = AccesoPagina::getInstacia();
$acceso instanceof AccesoPagina;
$sesion = SimpleSession::getInstancia();
$sesion instanceof SimpleSession;
$acceso->comprobarSesionAdmin(AccesoPagina::INICIO);
$categManager = new ProductoController();
$categoriaManager = new CategoriaController();
$categoriaDAO = CategoriaDAO::getInstancia();
$categoriaDAO instanceof CategoriaDAO;
$tablaCategorias = $categoriaDAO->findAll();

$paginador = new PaginadorMemoria(5, 100, $tablaCategorias);
$tablaCategoriasPaginada = $paginador->firstPage();
$paginador->init("categoria_paginador.php", "RESPUESTA");
$sesion->add(Session::PAGINADOR, $paginador);
?>

<!DOCTYPE html>

<html>
    <?php
    $pageContent = ContenidoPagina::getInstancia();
    $pageContent instanceof ContenidoPagina;
    $pageContent->getHead2();
    ?>
    <body>
        <div class="w3-container w3-card-8 w3-theme-d4" id="RTA"></div>
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
            <div class="w3-row w3-theme-d4 w3-center">
                <button class="w3-btn w3-hover-gray w3-yellow w3-medium w3-round" onclick="mostrarFormInsertCategoria();">
                    Nueva Categoría <span class="w3-badge w3-circle w3-purple">+</span>
                </button>
            </div>
            <!--            <div class="w3-row w3-container w3-padding-2">
                            <form action="controlador/negocio/categoria_insert.php" method="POST" name="categoria_insert" id="categoria_insert">
                                <label class="labels">Nombre</label>
                                <input type="text" minlength="5" maxlength="150" required placeholder="Nombre de la categoria" id="" name="" class="input_texto" onblur="valida_simple_input2(this, 5, 150);">
                                <br>
                                <label class="labels">Descripcion de la categoria</label>
                                <textarea class="m-textarea" id="" name="">
                                    Descripción (es opcional)
                                </textarea>
                                <br>
                                <label class="labels">Categoría a la que pertenece</label>
                                <div class="w3-center">
                                    <input type="submit" name="" id="" class="m-boton-a w3-small" value="Agregar">
                                    <a href="gestion_categorias.php"><button class="w3-btn w3-small w3-red w3-round-jumbo w3-large">Cancelar</button></a>
                                </div>
                            </form>
                        </div>-->
            <div id="RESPUESTA2"></div>
            <?php
            $paginador->maquetarBarraPaginacion();
            ?>
            <div id="RESPUESTA">
                <?php
                $categoriaManager->mostrarCategoriasCrudTable($tablaCategoriasPaginada);
                ?>
            </div>  
                <?php
                $paginador->maquetarBarraPaginacion();
                ?>
        </section>
            <?php
            $pageContent->getFooter2();
            ?>
    </body>
</html>

