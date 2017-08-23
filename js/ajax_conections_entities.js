/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function creaPeticion(varArray) {
    var peticion = "";
    for (var i = 0; i < varArray.length; i++) {

    }
}
function loadingGif(rta_id) {
    var rta_div = document.getElementById(rta_id);
    rta_div.innerHTML = '<div class="w3-modal" style="display: block"><div class="w3-modal-content w3-animate-top w3-transparent"> <img src="../media/img/loading.png" class="m-loading-gif w3-spin"> </div></div>';
}

function mostrarCardUserSesion() {
    var cardUser = document.getElementById("cardUser");
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/user_in_sesion.php");
    ajax.executeGet();
    ajax.responder(cardUser);
}

function insertar_usuario() {
    loadingGif("insert_res");
    var formulario = document.getElementById("RegistroCuenta");
    var divRTA = document.getElementById("insert_res");
    //Datos del usuario
    var idUsuario = document.getElementById("user_id").value;
    var emailUsuario = document.getElementById("user_email").value;
    var passUsuarioA = document.getElementById("user_passwordA").value;
    var passUsuarioB = document.getElementById("user_passwordB").value;
    //Datos de cuenta.

    var tipDocumCuenta = document.getElementById("cuenta_tip_doc").value;
    var numDocumCuenta = document.getElementById("cuenta_num_doc").value;
    var primNameCuenta = document.getElementById("cuenta_prim_name").value;
    var secNameCuenta = document.getElementById("cuenta_sec_name").value;
    var primApeCuenta = document.getElementById("cuenta_prim_ape").value;
    var secApeCuenta = document.getElementById("cuenta_sec_ape").value;
    var telCuenta = document.getElementById("cuenta_tel").value;

    var peticion = "";
    peticion += ("user_id=" + idUsuario + "&");
    peticion += ("user_password=" + passUsuarioA + "&");
    peticion += ("user_passwordB=" + passUsuarioB + "&");
    peticion += ("user_email=" + emailUsuario) + "&";
    //Datos de cuenta (Personal Inf.)
    peticion += ("cuenta_tip_doc=" + tipDocumCuenta) + "&";
    peticion += ("cuenta_num_doc=" + numDocumCuenta) + "&";
    peticion += ("cuenta_prim_name=" + primNameCuenta) + "&";
    peticion += ("cuenta_sec_name=" + secNameCuenta) + "&";
    peticion += ("cuenta_prim_ape=" + primApeCuenta) + "&";
    peticion += ("cuenta_sec_ape=" + secApeCuenta) + "&";
    peticion += ("cuenta_tel=" + telCuenta);

    // formulario.reset();
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/registrar_user.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(divRTA);
}
function login() {
    loadingGif("RTA");
    var RTA = document.getElementById("RTA");
    var idUserIp = document.getElementById("user_id");
    var passUserIp = document.getElementById("user_passwordA");

    var txtUserId = idUserIp.value;
    var txtPassUser = passUserIp.value;

    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/login.php");
    var peticion = "";
    peticion += "user_id=" + txtUserId + "&";
    peticion += "user_password=" + txtPassUser;

    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function cambiarPersonalData() {
    loadingGif("RTA");
    var RTA = document.getElementById("RTA");

    var emailUsuario = document.getElementById("user_email").value;
    var primNameCuenta = document.getElementById("cuenta_prim_name").value;
    var secNameCuenta = document.getElementById("cuenta_sec_name").value;
    var primApeCuenta = document.getElementById("cuenta_prim_ape").value;
    var secApeCuenta = document.getElementById("cuenta_sec_ape").value;
    var telCuenta = document.getElementById("cuenta_tel").value;

    var peticion = "";
    peticion += ("user_email=" + emailUsuario) + "&";
    peticion += ("cuenta_prim_name=" + primNameCuenta) + "&";
    peticion += ("cuenta_sec_name=" + secNameCuenta) + "&";
    peticion += ("cuenta_prim_ape=" + primApeCuenta) + "&";
    peticion += ("cuenta_sec_ape=" + secApeCuenta) + "&";
    peticion += ("cuenta_tel=" + telCuenta);

    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/update_personal_data.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function cambiarPassword() {
    loadingGif("RTA");
    var RTA = document.getElementById("RTA");
    var passA = document.getElementById("user_passwordA").value;
    var passB = document.getElementById("user_passwordB").value;

    var peticion = "";
    peticion += ("user_password=" + passA + "&");
    peticion += ("user_passwordB=" + passB);

    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/update_password.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function verCarritoComprasInModal() {
    var CAR = document.getElementById("CARRITO");
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_carrito_modal.php");
    ajax.executeGet();
    ajax.responder(CAR);
}
function agregarAlCarrito(target) {
    var CAR = document.getElementById("CARRITO");
    var hiden = target.childNodes[1];
    var idPro = hiden.value;
    var cantidad = document.getElementById(idPro).value;
    if (cantidad == 0) {
        cantidad = 1;
    }
    var peticion = "";
    peticion += "producto_id=" + idPro + "&";
    peticion += "producto_cantidad=" + cantidad;

    //window.alert(cantidad);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/add_to_carrito.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(CAR);
}
function findByCategoria(categoria) {
    loadingGif("RTA");
    var idCategoria = categoria.value;
    var RTA = document.getElementById("RTA");

    var peticion = "";
    peticion += ("producto_id_categoria=" + idCategoria);

    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/list_pro_by_cat.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function mostrarItemCarritoInModal(idProducto) {
    var ITEM = document.getElementById("item_carrito");
    var peticion = "producto_id=" + idProducto;
    //window.alert(peticion);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_item_modal.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(ITEM);
}
function mostrarUpdateFormProducto(divRTA) {
    var RTA = document.getElementById(divRTA);
    var inputId = document.getElementById("producto_id_search");
    var idProductoSearch = inputId.value;
    var peticion = "producto_id=" + idProductoSearch;
    loadingGif(divRTA);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_form_update_producto.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function mostrarUpdateFormProducto2(proId) {
    var RTA = document.getElementById("RESPUESTA");
    var peticion = "producto_id=" + proId;
    //loadingGif(RTA);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_form_update_producto.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function mostrarDisEnable(divRTA) {
    var RTA = document.getElementById(divRTA);
    var inputId = document.getElementById("producto_id_search_2");
    var idProductoSearch = inputId.value;
    var peticion = "producto_id=" + idProductoSearch;

    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_producto_dis_en.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}
function disable_enable_producto(divRTA, yn) {
    loadingGif(divRTA);
    var RTA = document.getElementById(divRTA);
    var peticion = "producto_activo=" + yn;
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/producto_enable_disable.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function disable_enable_producto(divRTA, yn, idProducto) {
    loadingGif(divRTA);
    var RTA = document.getElementById(divRTA);
    var peticion = "producto_activo=" + yn;
    peticion += "&producto_id=" + idProducto;
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/producto_enable_disable.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}


//Funciones para la Gestion de Categorias
//------------------------------------------------------------------

function disableEnableCategoria(idCategoria) {
    var RTA = document.getElementById("RESPUESTA");
    var peticion = "categoria_id=" + idCategoria;
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/categoria_enable_disable.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function mostrarFormUpdateCategoria(idCategoria) {
    loadingGif("RESPUESTA2");
    var RTA = document.getElementById("RESPUESTA2");
    var peticion = "categoria_id=" + idCategoria;
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_form_categoria_update.php");
    ajax.setPeticion(peticion);
    ajax.executePost();
    ajax.responder(RTA);
}

function mostrarFormInsertCategoria() {
    loadingGif("RESPUESTA2");
    var RTA = document.getElementById("RESPUESTA2");
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/ver_form_categoria_insert.php");
    ajax.executeGet();
    ajax.responder(RTA);
}
//------------------------------------------------------------------
// FUNCIONES PARA REALIZAR LA PAGINACION DE CUALQUIER ENTIDAD DTO
//------------------------------------------------------------------

function nextPage(fileNegocio, targetID) {
    loadingGif(targetID);
    var RTA = document.getElementById(targetID);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/" + fileNegocio + "?page=NEXT");
    ajax.executeGet();
    ajax.responder(RTA);
}

function prevPage(fileNegocio, targetID) {
    loadingGif(targetID);
    var RTA = document.getElementById(targetID);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/" + fileNegocio + "?page=PREV");
    ajax.executeGet();
    ajax.responder(RTA);
}

function lastPage(fileNegocio, targetID) {
    loadingGif(targetID);
    var RTA = document.getElementById(targetID);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/" + fileNegocio + "?page=LAST");
    ajax.executeGet();
    ajax.responder(RTA);
}

function firstPage(fileNegocio, targetID) {
    loadingGif(targetID);
    var RTA = document.getElementById(targetID);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/" + fileNegocio + "?page=FIRST");
    ajax.executeGet();
    ajax.responder(RTA);
}

function goPage(fileNegocio, targetID, pageNumber) {
    loadingGif(targetID);
    var RTA = document.getElementById(targetID);
    var ajax = new AjaxManager();
    ajax.setUrl("controlador/negocio/" + fileNegocio + "?page=" + pageNumber);
    ajax.executeGet();
    ajax.responder(RTA);
}
















































