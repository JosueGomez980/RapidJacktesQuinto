<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CuentaController
 *
 * @author SOPORTE
 */
include_once 'cargar_clases3.php';

class CuentaRequest extends Request {

    private $cuentaDTO;

    const cu_tip_doc = "cuenta_tip_doc";
    const cu_num_doc = "cuenta_num_doc";
    const cu_prim_name = "cuenta_prim_name";
    const cu_sec_name = "cuenta_sec_name";
    const cu_pri_ape = "cuenta_prim_ape";
    const cu_sec_ape = "cuenta_sec_ape";
    const cu_tel = "cuenta_tel";

    public function getCuentaDTO() {
        return $this->cuentaDTO;
    }

    public function setCuentaDTO(CuentaDTO $cuentaDTO) {
        $this->cuentaDTO = $cuentaDTO;
    }

    public function __construct() {
        parent::__construct();
    }

    public function doDelete() {
        return NULL;
    }

    public function doGet() {
        $cuentaTemp = new CuentaDTO();
        if (isset($_GET[self::cu_tip_doc])) {
            $cuentaTemp->setTipoDocumento($_GET[self::cu_tip_doc]);
        }
        if (isset($_GET[self::cu_num_doc])) {
            $cuentaTemp->setNumDocumento($_GET[self::cu_num_doc]);
        }
        if (isset($_GET[self::cu_prim_name])) {
            $cuentaTemp->setPrimerNombre($_GET[self::cu_prim_name]);
        }
        if (isset($_GET[self::cu_sec_name])) {
            $cuentaTemp->setSegundoNombre($_GET[self::cu_sec_name]);
        }
        if (isset($_GET[self::cu_pri_ape])) {
            $cuentaTemp->setPrimerApellido($_GET[self::cu_pri_ape]);
        }
        if (isset($_GET[self::cu_sec_ape])) {
            $cuentaTemp->setSegundoApellido($_GET[self::cu_sec_ape]);
        }
        if (isset($_GET[self::cu_tel])) {
            $cuentaTemp->setTelefono($_GET[self::cu_tel]);
        }
        $this->cuentaDTO = $cuentaTemp;
    }

    public function doHead() {
        return NULL;
    }

    public function doPost() {
        $cuentaTemp = new CuentaDTO();
        if (isset($_POST[self::cu_tip_doc])) {
            $cuentaTemp->setTipoDocumento($_POST[self::cu_tip_doc]);
        }
        if (isset($_POST[self::cu_num_doc])) {
            $cuentaTemp->setNumDocumento($_POST[self::cu_num_doc]);
        }
        if (isset($_POST[self::cu_prim_name])) {
            $cuentaTemp->setPrimerNombre($_POST[self::cu_prim_name]);
        }
        if (isset($_POST[self::cu_sec_name])) {
            $cuentaTemp->setSegundoNombre($_POST[self::cu_sec_name]);
        }
        if (isset($_POST[self::cu_pri_ape])) {
            $cuentaTemp->setPrimerApellido($_POST[self::cu_pri_ape]);
        }
        if (isset($_POST[self::cu_sec_ape])) {
            $cuentaTemp->setSegundoApellido($_POST[self::cu_sec_ape]);
        }
        if (isset($_POST[self::cu_tel])) {
            $cuentaTemp->setTelefono($_POST[self::cu_tel]);
        }
        $this->cuentaDTO = $cuentaTemp;
    }

    public function doPut() {
        return NULL;
    }

    public function doRequest() {
        return NULL;
    }

}

class CuentaController implements Validable, GenericController {

    private $cuentaDAO;
    private $content;

    public function __construct() {
        $this->cuentaDAO = new CuentaDAO();
        $this->content = new ContentManager();
    }

    public function actualizar(EntityDTO $entidad) {
        $ok = FALSE;
        $entidad instanceof CuentaDTO;
        $rta = $this->cuentaDAO->update($entidad);
        switch ($rta) {
            case 1: {
                    $this->content->setFormato(new Exito());
                    $this->content->setContenido("La información personal se guardó correctamente. Se aplicaron los cambios");
                    $ok = TRUE;
                    break;
                }
            case 0: {
                    $this->content->setFormato(new Neutral());
                    $this->content->setContenido("No se registraron cambios en los datos de cueta");
                    break;
                }
            case -1: {
                    $this->content->setFormato(new Errado());
                    $this->content->setContenido("Hubo un error grave al momento de realizar la operacion :( Por favor revise los datos e intente de nuevo.");
                    break;
                }
        }
        return $ok;
    }

    public function eliminar(EntityDTO $entidad) {
        
    }

    public function encontrar(EntityDTO $entidad) {
        
    }

    public function encontrarTodos() {
        
    }

    public function insertar(EntityDTO $entidad) {
        $rta = FALSE;
        $entidad instanceof CuentaDTO;
        if ($this->validaPK($entidad)) {
            $this->content->setFormato(new Errado);
            $this->content->setContenido("El numero de documento " . $entidad->getNumDocumento() . " ya existe. Por favor digite uno diferente.");
        } else {
            $rta = $this->cuentaDAO->insert($entidad);
            switch ($rta) {
                case 1: {
                        $this->content->setFormato(new Exito());
                        $this->content->setContenido("La información personal se guardó correctamente.");
                        $rta = FALSE;
                        break;
                    }
                case 0: {
                        $this->content->setFormato(new Errado());
                        $this->content->setContenido("No se pudo registrar la información personal correctamente. Intente de nuevo.");
                        break;
                    }
                case -1: {
                        $this->content->setFormato(new Errado());
                        $this->content->setContenido("Hubo un error grave al momento de realizar la operacion :(");
                        break;
                    }
            }
        }
        return $rta;
    }

    public function validaFK(EntityDTO $entidad) {
        $entidad instanceof UsuarioDTO;
        $userDAO = UsuarioDAO::getInstancia(); // <<<--
        if (is_null($userDAO->find($entidad))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validaPK(EntityDTO $entidad) {
        $entidad instanceof CuentaDTO;
        if (is_null($this->cuentaDAO->find($entidad))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
