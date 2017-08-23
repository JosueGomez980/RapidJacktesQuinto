<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoMaquetador
 *
 * @author Josué Francisco
 */
class ProductoMaquetador implements GenericMaquetador {

    public function maquetaArrayObject(array $entidades) {
        echo('<div class="w3-row" id="productos_principal">');
        foreach ($entidades as $producto) {
            $producto instanceof ProductoDTO;
            $nombre = $producto->getNombre();
            $precio = Validador::formatPesos($producto->getPrecio());
            $idProducto = base64_encode($producto->getIdProducto());
            $idProductoUrl = CriptManager::urlVarEncript($producto->getIdProducto());
            $foto = $this->urlFoto($producto->getFoto());
            $cantidad = $producto->getCantidad();

            if ($producto->getActivo()) {
                echo('<div class="w3-col m4 l2 s10">
                        <div class="w3-card-8 w3-white m-producto-card">
                            <a href="producto_ficha_tecnica.php?producto_id=' . $idProductoUrl . '"><img src="' . $foto . '" alt="' . $nombre . '" title="' . $nombre . '" class="m-producto-view-1-img"></a>
                            <input type="hidden" value="' . $idProducto . '">
                            <div class="w3-container w3-white m-producto-name">
                                <span>' . $nombre . '</span>                                
                            </div>
                            <div class="w3-row w3-theme-d1">
                                <div class="w3-half w3-center">
                                    <span class="w3-badge w3-black w3-padding-4">' . $precio . '</span>
                                </div>
                                <div class="w3-half w3-center">
                                    <button class="m-boton-add-carrito" onclick="agregarAlCarrito(this)">
                                        <input type="hidden" value="' . $idProducto . '">
                                        <img src="../media/img/carrito_compra.png" alt="Agregar al carrito" title="Agregar al carrito" class="m-carrito">
                                        Agregar al carrito
                                    </button>
                                </div>
                                <div class="w3-center"><input type="number" id="' . $idProducto . '" class="input_carrito w3-center" max="' . $cantidad . '" min="1" placeholder="Cantidad"></div>
                            </div>
                        </div>
                    </div>');
            }
        }
        echo('</div>');
    }

    public function urlFoto($foto) {
        if ($foto == "SIN_ASIGNAR") {
            return "../media/img/default_foto.png";
        } else {
            return $foto;
        }
    }

    public function maquetaCategoriasForUser() {
        $categoriaDAO = new CategoriaDAO();
        $categorias = $categoriaDAO->findAll();
        echo('<select name="categoria_id" id="categoria_id" class="m-selects" onchange="findByCategoria(this);">');
        foreach ($categorias as $cat) {
            $cat instanceof CategoriaDTO;
            $idCat = $cat->getIdCategoria();
            $nombre = Validador::fixTexto($cat->getNombre());
            if ($cat->getActiva() && $cat->getIdCategoria() !== $cat->getCategoriaIdCategoria()) {
                echo('<option value="' . $idCat . '">' . $nombre . '</option>');
            }
        }
        echo('</select>');
    }

    public function maquetaObject(EntityDTO $entidad) {
        //Meto para mostrar un producto en su modod de ficha Tecnica
        $entidad instanceof ProductoDTO;
        $categoriaDAO = CategoriaDAO::getInstancia();
        $categoriaDAO instanceof CategoriaDAO;
        $catFind = new CategoriaDTO();
        $catFind->setIdCategoria($entidad->getCategoriaIdCategoria());
        $cateDTO = $categoriaDAO->find($catFind);

        $idProducto = base64_encode($entidad->getIdProducto());
        $categoriaNombre = $cateDTO->getNombre();
        $nombre = $entidad->getNombre();
        $precio = Validador::formatPesos($entidad->getPrecio());
        $descripcion = $entidad->getDescripcion();
        $cantidadDisponible = $entidad->getCantidad();
        $urlFoto = $this->urlFoto($entidad->getFoto());


        echo('<div id="' . $entidad->getIdProducto() . '" class="w3-container w3-theme-l5">
                <div id="modal_pro_full_image" class="w3-modal">
                    <span class="w3-closebtn w3-white w3-hover-red w3-container w3-padding-16 w3-display-topright w3-xxlarge" onclick="hide_closebtn(this)">×</span>
                    <img src="' . $urlFoto . '" class="w3-modal-content w3-animate-zoom m-producto-full-img">
                </div>
                <div class="w3-row">
                    <div class="w3-quarter w3-card-4">
                        <img class="m-producto-mq-image" src="' . $urlFoto . '" alt="' . $nombre . '" title="' . $nombre . '" onclick="show_modal(\'modal_pro_full_image\');">
                    </div>
                    <div class="w3-threequarter w3-container w3-card-4">
                        <div class=" m-producto-big-name">' . $nombre . '</div><br>
                        <span class="m-tituloA">Categoria : <b>' . $categoriaNombre . '</b></span>
                        <div class="w3-row">
                            <div class="w3-half w3-container w3-card-4 w3-center">
                                <span class="w3-tag w3-theme-d5 w3-large">Precio</span>
                                <span class="w3-badge w3-light-green w3-large w3-padding-12">' . $precio . '</span>
                            </div>
                            <div class="w3-half w3-container w3-card-4 w3-center">
                                <span class="w3-badge w3-light-green w3-large w3-padding-12">' . $cantidadDisponible . '</span>
                                <span class="w3-tag w3-theme-d5 w3-large">Unidades Disponibles</span>
                            </div>
                        </div>
                        <p class="w3-justify w3-theme-light w3-large">
                            ' . $descripcion . '
                        </p>
                    </div>
                </div>
                <div class="w3-row">
                    <div class="w3-quarter w3-container w3-theme-d3 w3-padding-8 w3-center">
                        <button class="m-boton-add-carrito" onclick="agregarAlCarrito(this)">
                            <input type="hidden" value="' . $idProducto . '">
                            <img src="../media/img/carrito_compra.png" alt="Agregar al carrito" title="Agregar al carrito" class="m-carrito">
                            Agregar al carrito
                        </button>
                        <input type="number" id="' . $idProducto . '" class="input_carrito w3-center" max="' . $cantidadDisponible . '" min="1" placeholder="Cantidad">
                    </div>
                </div>
            </div>');
    }

    public function maquetaUpdateFormProducto(ProductoDTO $producto) {
        $catDTO = new CategoriaDTO();
        $catDTO->setIdCategoria($producto->getCategoriaIdCategoria());
        $catDAO = new CategoriaDAO();
        $catFinded = $catDAO->find($catDTO);
        $categoriaManager = new CategoriaController();
        $descripcion = Validador::fixTexto($producto->getDescripcion());
        $nombre = Validador::fixTexto($producto->getNombre());
        $urlFoto = $this->urlFoto($producto->getFoto());
        $precio = $producto->getPrecio();
        $idProductoUrl = CriptManager::urlVarEncript($producto->getIdProducto());
        echo('<form method="POST" id="update_producto" name="update_producto" action="controlador/negocio/producto_update.php" enctype="multipart/form-data">
                        <div class="w3-row">
                            <div class="w3-quarter w3-container"></div>
                            <div class="w3-half w3-container">
                                <label class="labels">Nombre</label>
                                <input type="text" class="input_texto" name="' . ProductoRequest::pro_name . '" id="' . ProductoRequest::pro_name . '" required onblur="valida_simple_input(this)" value="' . $nombre . '">
                                <label class="labels">Categoria asociada</label>');

        $categoriaManager->mostrarCategoriaSelect(ProductoRequest::pro_id_cat, ProductoRequest::pro_id_cat, $catFinded);
        echo('<br>
                <input type="hidden" name="' . ProductoRequest::pro_id . '" value="' . $idProductoUrl . '" />
                <label class="labels">Descripción</label>
                <textarea class="m-textarea" id="producto_descripcion" name="producto_descripcion" required>' . $descripcion . '</textarea>
                <br><br>
                <label class="labels">Cambiar o colocar la imagen (Opcional)</label>
                <!---------------------------------------------------------------------------------->
                <label class="labels">Imagen actual</label>
                <div class="w3-row">
                    <div class="w3-center w3-col s8 m5 l3 w3-card-12 w3-white">
                        <img src="' . $urlFoto . '" id="producto_img_vista_previa" style="width: 100%; height: auto" title="' . $nombre . '" alt="' . $nombre . '">
                    </div>
                </div><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="' . FileUpload::DOS_MB . '" />
                <input type="file" name="producto_image" id="producto_image" class="w3-btn w3-hover-lime w3-aqua" value="Seleccione una imagen">
                <br><br>
                <label class="labels">Precio<span class="w3-badge">$</span></label>
                <input type="number" value="' . $precio . '" class="input_number" min="1" max="9999999999" name="producto_precio" id="producto_precio" onblur="valida_simple_input(this)">
                    <div class="w3-center w3-container w3-padding-4 w3-theme-l1">
                        <input type="submit" name="envio" id="enviar" value="Modificar"  class="m-boton-a w3-green">
                        <a href="admin_panel.php"><button class="m-boton-a w3-red" name="cancelar" id="cancel">Cancelar</button></a>
                    </div>
                </div>
                <div class="w3-quarter w3-container"></div>
            </div>
        </form>');
    }

    public function maquetaProductoDisableEnable(ProductoDTO $producto) {
        $nombre = $nombreT = Validador::fixTexto($producto->getNombre());
        if ($producto->getActivo()) {
            $nombre = "<span class='w3-text-green'>" . $nombre . "</span><br><span class='w3-tiny w3-green'>HABILITADO</span>";
        } else {
            $nombre = "<span class='w3-text-grey'>" . $nombre . "</span><br><span class='w3-tiny w3-grey'>DESABILITADO</span>";
        }
        $urlFoto = $this->urlFoto($producto->getFoto());
        $idPro = $producto->getIdProducto();
        echo('<div class="w3-row">
                    <div class="w3-quarter w3-container"></div>
                    <div class="w3-half w3-container w3-white w3-card-8 w3-padding-4">
                        <div class="w3-row">
                            <h4 class="w3-center w3-card-8 w3-lime w3-round-medium">ACTIVAR/DESACTIVAR PRODUCTO CON ID ' . $idPro . '</h4>
                          <div class="w3-threequarter">
                            <span class="w3-large w3-text-shadow">' . $nombre . '</span>
                          </div>
                          <div class="w3-quarter">
                            <img src="' . $urlFoto . '" id="producto_img_vista_previa" style="width: 100%; height: auto" title="' . $nombreT . '" alt="' . $nombreT . '" class="w3-card-8">
                          </div> 
                        </div>
                        <br>
                        <div class="w3-center w3-container w3-padding-4 w3-theme-l1">');
        if ($producto->getActivo()) {
            echo('<button class = "m-boton-a w3-red" onclick = "disable_enable_producto(\'RESPUESTA\', 0)">Desactivar</button>');
        } else {
            echo('<button class = "m-boton-a w3-green" onclick = "disable_enable_producto(\'RESPUESTA\', 1)">Activar</button>');
        }

        echo('</div>
                <hr>
                </div>
                    <div class="w3-quarter w3-container"></div>
            </div>');
    }

    public function maquetaProductoTablaCrud(array $productos) {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        $paginador = $sesion->getEntidad(Session::PAGINADOR);
        $paginador instanceof PaginadorMemoria;
        $pageActual = $paginador->getPaginaActual();
        $totalPages = $paginador->getNumeroPaginas();
        $cantidad = count($productos);
        echo('<div class="w3-theme-l4 w3-card-4">
                <div class="w3-round-large w3-teal w3-xlarge w3-container">
                    Obtenidos ' . $cantidad . ' Productos
                    <br> <span class="w3-tag w3-round-medium w3-small w3-theme-d1">Página ' . ($pageActual) . ' de ' . $totalPages . '</span>
                </div>  
                <table class="w3-table-all w3-small w3-responsive">
                    <tr class="w3-light-green">
                        <th>ID</th>
                        <th>NOMBRE DEL PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>Actualizar</th>
                        <th>Activar/Desactivar</th>
                    </tr>');
        foreach ($productos as $pro) {
            $pro instanceof ProductoDTO;
            $nombre = $pro->getNombre();
            $idMostrar = $pro->getIdProducto();
            $precio = Validador::formatPesos($pro->getPrecio());
            $estado = $pro->getActivo();
            $estadoM = "";
            echo('<tr class="w3-hover-light-blue w3-white">
                        <td>' . $idMostrar . '</td>
                        <td>' . $nombre . '</td>
                        <td>' . $precio . '</td>');
            if ($estado) {
                echo('<td>Activo</td>');
                $estadoM = '<button class="w3-btn w3-tiny w3-red w3-round w3-hover-gray" onclick = "disable_enable_producto(\'RESPUESTA\', 0, \'' . $idMostrar . '\');">Desactivar</button>';
            } else {
                echo('<td>Inactivo</td>');
                $estadoM = '<button class="w3-btn w3-tiny w3-green w3-round w3-hover-gray" onclick = "disable_enable_producto(\'RESPUESTA\', 1, \'' . $idMostrar . '\');">Activar</button>';
            }
            echo('<td>
                        <img class="m-crud_icons" src="../media/img/update_icon.png" onclick="mostrarUpdateFormProducto2(\'' . $idMostrar . '\');">
                    </td>
                    <td>
                       ' . $estadoM . ' 
                    </td>
                </tr>');
        }
        echo('</table>
            </div>');
    }

    public function generarStringReporteA(array $productos, $hojaCss) {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        $cuentaAdmin = $sesion->getEntidad(Session::CU_ADMIN_LOGED);
        $cuentaAdmin instanceof CuentaDTO;
        $userAdmin = $sesion->getEntidad(Session::US_ADMIN_LOGED);
        $userAdmin instanceof UsuarioDTO;
        $idUser = utf8_decode($userAdmin->getIdUsuario());
        $nombreAdmin = utf8_decode($cuentaAdmin->getPrimerNombre() . " " . $cuentaAdmin->getPrimerApellido());
        $dater = new DateManager();
        $fecha = $dater->dateSpa1();
        $salida = null;
        $salida = '<style>' . $hojaCss . '</style>';
        $cantidad = count($productos);
        $salida .= ('  
                <div class="head1">
                     <div class="img-logo"><img src="../media/img/logo.png"></div> 
                     <p>
                        Obtenidos ' . $cantidad . ' productos<br><br>
                        Fecha de generación de reporte: ' . $fecha . '<br>
                        Reporte solicitado por: ' . $nombreAdmin . ' (' . $idUser . ')
                     </p>     
                </div>
               <table class="">
                    <tr class="lol">
                        <th>ID</th>
                        <th>NOMBRE DEL PRODUCTO</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>CANTIDAD</th>
                        <th>CATEGORIA</th>
                        <th>FOTO</th>
                    </tr>');
        $cateDAO = CategoriaDAO::getInstancia();
        $cateDAO instanceof CategoriaDAO;
        foreach ($productos as $pro) {
            $catSearch = new CategoriaDTO();
            $catSearch->setIdCategoria($pro->getCategoriaIdCategoria());
            $cateFinded = $cateDAO->find($catSearch);
            $pro instanceof ProductoDTO;
            $nombre = $pro->getNombre();
            $cant = $pro->getCantidad();
            $idMostrar = $pro->getIdProducto();
            $precio = Validador::formatPesos($pro->getPrecio());
            $estado = $pro->getActivo();
            $categoriaNombre = $cateFinded->getNombre();

            $salida .= '<tr class="lol">
                        <td>' . $idMostrar . '</td>
                        <td>' . $nombre . '</td>
                        <td>' . $precio . '</td>';
            if ($estado) {
                $salida .= '<td>Activo</td>';
            } else {
                $salida .= '<td>Inactivo</td>';
            }
            $salida .= '<td>' . $cant . '</td>';
            $salida .= '<td>' . $categoriaNombre . '</td>';
            $salida .= '<td><img style="width: 50px; height: 50px;" src="' . $this->urlFoto($pro->getFoto()) . '"></td>';

            $salida .= '</tr>';
        }
        $salida .= '</table>';
        return $salida;
    }

}
