<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Josué Francisco
 */
interface EntityDTO{

}

interface DAOPaginable{
    public function findByPaginationLimit($inicio, $cantidad);
}
