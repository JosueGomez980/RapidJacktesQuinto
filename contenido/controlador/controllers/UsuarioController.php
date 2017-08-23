<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioController
 *
 * @author Josué Francisco
 */
include_once 'cargar_clases3.php';

AutoCarga3::init();

class UsuarioRequest extends Request {

    private $usuarioDTO;

    const us_id = "user_id";
    const us_pass = "user_password";
    const us_rol = "user_rol";
    const us_estado = "user_estado";
    const us_mail = "user_email";

    public function __construct() {
        parent::__construct();
    }

    public function getUsuarioDTO() {
        return $this->usuarioDTO;
    }

    public function setUsuarioDTO(UsuarioDTO $usuarioDTO) {
        $this->usuarioDTO = $usuarioDTO;
    }

    //Cuando al instanciarse esta clase se detecta que la forma de envio es Get, se ejecuta este metodo
    public function doGet() {
        $userTemp = new UsuarioDTO();
        if (isset($_GET[self::us_id])) {
            $userTemp->setIdUsuario($_GET[self::us_id]);
        }
        if (isset($_GET[self::us_pass])) {
            $userTemp->setPassword($_GET[self::us_pass]);
        }
        if (isset($_GET[self::us_rol])) {
            $userTemp->setRol($_GET[self::us_rol]);
        }
        if (isset($_GET[self::us_estado])) {
            $userTemp->setEstado($_GET[self::us_estado]);
        }
        if (isset($_GET[self::us_mail])) {
            $userTemp->setEmail($_GET[self::us_mail]);
        }
        $this->usuarioDTO = $userTemp; // Al final la propiedad private $usuarioDTO; se le asigna la instancia temporal. Sin ningua variable fue detectada 
    }

    public function doPost() {
        $userTemp = new UsuarioDTO();
        if (isset($_POST[self::us_id])) {
            $userTemp->setIdUsuario($_POST[self::us_id]);
        }
        if (isset($_POST[self::us_pass])) {
            $userTemp->setPassword($_POST[self::us_pass]);
        }
        if (isset($_POST[self::us_rol])) {
            $userTemp->setRol($_POST[self::us_rol]);
        }
        if (isset($_POST[self::us_estado])) {
            $userTemp->setEstado($_POST[self::us_estado]);
        }
        if (isset($_POST[self::us_mail])) {
            $userTemp->setEmail($_POST[self::us_mail]);
        }
        $this->usuarioDTO = $userTemp;
    }

    public function doDelete() {
        return NULL;
    }

    public function doHead() {
        return NULL;
    }

    public function doPut() {
        return NULL;
    }

    public function doRequest() {
        $userTemp = new UsuarioDTO();
        if (isset($_REQUEST[self::us_id])) {
            $userTemp->setIdUsuario($_REQUEST[self::us_id]);
        }
        if (isset($_REQUEST[self::us_pass])) {
            $userTemp->setPassword($_REQUEST[self::us_pass]);
        }
        if (isset($_REQUEST[self::us_rol])) {
            $userTemp->setRol($_REQUEST[self::us_rol]);
        }
        if (isset($_REQUEST[self::us_estado])) {
            $userTemp->setEstado($_REQUEST[self::us_estado]);
        }
        if (isset($_REQUEST[self::us_mail])) {
            $userTemp->setEmail($_REQUEST[self::us_mail]);
        }
        $this->usuarioDTO = $userTemp;
    }

}

class UsuarioController implements Validable, GenericController {

    private $usuarioDAO;
    protected $contentMgr;
    private $usuarioMQT;

    public function __construct() {
        $this->usuarioDAO = UsuarioDAO::getInstancia();
        $this->contentMgr = ContentManager::getInstancia();
        $this->usuarioMQT = new UsuarioMaquetador();
    }

    public function validaFK(EntityDTO $entidad) {
        return NULL;
    }

    //Retorna TRUE si no se encuentra un usuario que tenga ese id y FALSE si lo encuentra
    public function validaPK(EntityDTO $entidad) {
        $res = TRUE;
        if ($this->usuarioDAO->find($entidad) != NULL) {
            $res = FALSE;
        }
        return $res;
    }

    public function insertar(EntityDTO $entidad) {
        $rta = FALSE;
        $entidad instanceof UsuarioDTO;
        if (!$this->validaPK($entidad)) {
            $this->contentMgr->setFormato(new Errado());
            $this->contentMgr->setContenido("No puedes escoger este usuario (" . Validador::fixTexto($entidad->getIdUsuario()) . "). Pues ya está en uso. Debes elegir otro");
        } else {
            $res = $this->usuarioDAO->insert($entidad);
            switch ($res) {
                case 1: {
                        $this->contentMgr->setFormato(new Exito());
                        $this->contentMgr->setContenido("¡ Los datos de usuario han sido registrados exitosamente <br>Ahora puedes Iniciar sesión con los datos que has enviado <a href='iniciar_sesion.php'><h4>Log In</h4></a>");
                        $rta = TRUE;
                        break;
                    }
                case 0: {
                        $this->contentMgr->setFormato(new Errado());
                        $this->contentMgr->setContenido("No se pudo registrar el usuario " . Validador::fixTexto($entidad->getIdUsuario()) . ". Por favor intente de nuevo");
                        break;
                    }
                case -1: {
                        $this->contentMgr->setFormato(new Errado());
                        $this->contentMgr->setContenido("Hubo un error grave al momento de realizar la operacion :(");
                        break;
                    }
            }
        }
        return $rta;
    }

    public function actualizar(EntityDTO $entidad) {
        $ok = FALSE;
        $entidad instanceof UsuarioDTO;
        $rta = $this->usuarioDAO->update($entidad);
        switch ($rta) {
            case 1: {
                    $this->contentMgr->setFormato(new Exito());
                    $this->contentMgr->setContenido("Los datos de logeo se han guardado. Se aplicaron los cambios");
                    $ok = TRUE;
                    break;
                }
            case 0: {
                    $this->contentMgr->setFormato(new Neutral());
                    $this->contentMgr->setContenido("No se detectaron cambios en los datos de logeo");
                    $ok = TRUE;
                    break;
                }
            case -1: {
                    $this->contentMgr->setFormato(new Errado());
                    $this->contentMgr->setContenido("Hubo un error grave al intentar modificar este usuario. Por favor verifique la informacion e intente otra vez.");
                    break;
                }
        }
        return $ok;
    }

    public function cambiarContrasena(UsuarioDTO $usuario) {
        $ok = FALSE;
        $rta = $this->usuarioDAO->updatePassword($usuario);
        switch ($rta) {
            case 1: {
                    $this->contentMgr->setFormato(new Exito());
                    $this->contentMgr->setContenido("Tu contraseña fue cambiada correctamente");
                    $ok = TRUE;
                    break;
                }
            case 0: {
                    $this->contentMgr->setFormato(new Neutral());
                    $this->contentMgr->setContenido("No se detectaron cambios en tu contraseña");
                    $ok = TRUE;
                    break;
                }
            case -1: {
                    $this->contentMgr->setFormato(new Errado());
                    $this->contentMgr->setContenido("Hubo un error grave al intentar modificar tu contraseña. Por favor verifique la contraseña e intente otra vez.");
                    break;
                }
        }
        return $ok;
    }

    public function eliminar(EntityDTO $entidad) {
        $entidad instanceof UsuarioDTO;
        $rta = $this->usuarioDAO->update($entidad);
        switch ($rta) {
            case 1: {
                    $this->contentMgr->setFormato(new Exito());
                    $this->contentMgr->setContenido("El usuario " . $entidad->getIdUsuario() . " fue eliminado correctamente y de forma permanente del sistema");
                    break;
                }
            case 0: {
                    $this->contentMgr->setFormato(new Neutral());
                    $this->contentMgr->setContenido("No se encontró un usuario con el id " . $entidad->getIdUsuario() . " . No se llevó a cabo una eliminacion.");
                    break;
                }
            case -1: {
                    $this->contentMgr->setFormato(new Errado());
                    $this->contentMgr->setContenido("Hubo un error grave al intentar eliminar este usuario. Por favor verifique la informacion e intente otra vez.");
                    break;
                }
        }
    }

    public function encontrar(EntityDTO $entidad) {
        $entidad instanceof UsuarioDTO;
        $userFinded = $this->usuarioDAO->find($entidad);
        if (!is_null($userFinded)) {
            $this->usuarioMQT->maquetaObject($userFinded);
        } else {
            $this->contentMgr->setFormato(new Neutral());
            $this->contentMgr->setContenido("No se han encontrado resultados.");
        }
        return $userFinded;
    }

    public function encontrarTodos() {
        $usuarios = $this->usuarioDAO->findAll();
        $this->usuarioMQT->maquetaArrayObject($usuarios);
        return $usuarios;
    }

    public function encontrarByEmail(UsuarioDTO $user) {
        $usuario = NULL;
        if (!is_null($this->usuarioDAO->findByEmail($user))) {
            $usuario = $this->usuarioDAO->findByEmail($user);
        }
        return $usuario;
    }

    public function mostrarCardUsuario() {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if ($sesion->existe(Session::US_LOGED)) {
            $usuario = $sesion->getEntidad(Session::US_LOGED);
            $cuenta = $sesion->getEntidad(Session::CU_LOGED);
            $this->usuarioMQT->maquetaCardSesion($usuario, $cuenta);
        }
    }

    public function mostrarManagerLink() {
        $sesion = SimpleSession::getInstancia();
        $sesion instanceof SimpleSession;
        if($sesion->existe(Session::US_ADMIN_LOGED)){
            $userMgr = $sesion->getEntidad(Session::CU_LOGED);
            $usName = Validador::fixTexto($userMgr->getPrimerNombre())." ".Validador::fixTexto($userMgr->getPrimerApellido());
            $this->usuarioMQT->maquetarManagerLink($usName);
        }
    }

    public function validaManagerLogin(UsuarioDTO $user) {
        $ok = FALSE;
        if ($user->getRol() == UsuarioDAO::ROL_MAIN_ADMIN) {
            $ok = TRUE;
        }
        return $ok;
    }

    public function validaSubManagerLogin(UsuarioDTO $user) {
        $ok = FALSE;
        if ($user->getRol() == UsuarioDAO::ROL_SUB_ADMIN) {
            $ok = TRUE;
        }
        return $ok;
    }
}
