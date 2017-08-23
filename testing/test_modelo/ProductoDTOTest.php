<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoDAOTest
 *
 * @author SOPORTE
 */
use PHPUnit\Framework\TestCase;

require_once '../../contenido/modelo/dao/ProductoDTO.php';

class ProductoDTOTest extends TestCase {

    private $proDTO;
    
    public function testNum1() {
        $this->proDTO = new ProductoDTO();
        $this->proDTO->setIdProducto("PRO001");
        $this->proDTO->setNombre("Elkinsiquejode");
        $this->proDTO->setCantidad(12);
        echo(json_encode($this->proDTO));
    }

}

$test = new ProductoDTOTest();
$test->testNum1();
