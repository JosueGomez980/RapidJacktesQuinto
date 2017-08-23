<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarritoComprasController
 *
 * @author SOPORTE
 */
include_once 'cargar_clases3.php';
AutoCarga3::init();

class CarritoComprasController {

    const IVA = 0.19;

    private $carritoMQT = NULL;
    private $instancia = NULL;
    private $contentMGR = NULL;
    private $carrito = NULL;

    public function __construct() {
        $this->carritoMQT = new CarritoComprasMaquetador();
        $this->contentMGR = new ContentManager();
    }

    public static function getInstancia() {
        if (is_null($this->instancia)) {
            $this->instancia = new CarritoComprasController();
        }
        return $this->instancia;
    }

    public function getCarrito() {
        return $this->carrito;
    }

    public function setCarrito(CarritoComprasDTO $carrito) {
        $this->carrito = $carrito;
    }

    public function mostrarCarrito(CarritoComprasDTO $carrito) {
        $this->carritoMQT->maquetaCarritoInModal($carrito);
    }

    public function calcularCarrito(CarritoComprasDTO $carrito, $conImpuesto) {
        $totalCarrito = 0;
        $subTotalCarrito = 0;
        $impuestosCarrito = 0;
        $itemsCarrito = $carrito->getItems();

        //Nuevos items con los datos calculados para asignar al carrito de compras;
        $newItems = array();
        foreach ($itemsCarrito as $item) {
            $totalItem = 0;
            $impuestosItem = 0;
            //Calcular los datos para asignar al nuevo item
            $item instanceof ItemCarritoDTO;
            $producto = $item->getProducto();
            $producto instanceof ProductoDTO;
            $newItem = new ItemCarritoDTO($producto);
            $subtotalItem = $producto->getPrecio() * $item->getCantidad();
            $impuestosItem = $subtotalItem * self::IVA;
            if ($conImpuesto) {
                $totalItem = $subtotalItem + $impuestosItem;
            } else {
                $totalItem = $subtotalItem;
            }


            //Asignar los valores al nuevo item...
            $newItem->setCantidad($item->getCantidad());
            $newItem->setImpuestos($impuestosItem);
            $newItem->setCostoUnitario($producto->getPrecio());
            $newItem->setCostoTotal($totalItem);

            //Acumular los nuevos valores en las variables para asigna a las propiedades del carrito
            $subTotalCarrito += $totalItem;
            $impuestosCarrito += $impuestosItem;
            //Agregar el nuevo item a la nueva lista de items;
            $newItems[] = $newItem;
        }
        $carrito->setItems($newItems);
        $totalCarrito = $subTotalCarrito;

        $carrito->setSubtotal($subTotalCarrito);
        $carrito->setImpuestos($impuestosCarrito);
        $carrito->setTotal($totalCarrito);
        $this->carrito = $carrito;
        return $carrito;
    }

    public function mostrarCarritoCompleto(CarritoComprasDTO $carrito) {
        $this->carritoMQT->maquetaObject($carrito);
    }
    public function mostrarItemCarritoToEdit(ItemCarritoDTO $itemDisplay){
        $this->carritoMQT->maquetaItemCarrito($itemDisplay);
    }
    
    public function existeEnCarrito(CarritoComprasDTO $carrito, ProductoDTO $prod) {
        $ok = FALSE;
        $items = $carrito->getItems();
        foreach ($items as $it) {
            $it instanceof ItemCarritoDTO;
            $proIt = $it->getProducto();
            $proIt instanceof ProductoDTO;
            if ($proIt->getIdProducto() == $prod->getIdProducto()) {
                $ok = TRUE;
                break;
            }
        }
        return $ok;
    }
    public function findItemByIdProducto(CarritoComprasDTO $carrito, $idProducto){
        $itemFinded = NULL;
        $items = $carrito->getItems();
        foreach ($items as $it) {
            $it instanceof ItemCarritoDTO;
            $proIt = $it->getProducto();
            $proIt instanceof ProductoDTO;
            if ($proIt->getIdProducto() == $idProducto) {
                $itemFinded = $it;
                break;
            }
        }
        return $itemFinded;
    }
    public function getIndxOf(CarritoComprasDTO $carrito, ItemCarritoDTO $item){
        $idx = 0;
        $items = $carrito->getItems();
        $proSearch = $item->getProducto();
        $proSearch instanceof ProductoDTO;
        for ($index = 0; $index < count($items); $index++) {
            $it = $items[$index];
            $it instanceof ItemCarritoDTO;
            $prodItem = $it->getProducto();
            $prodItem instanceof ProductoDTO;
            if($proSearch->getIdProducto() == $prodItem->getIdProducto()){
                $idx = $index;
                break;
            }
        }
        return $idx;
    }

    public function findItemIndx(CarritoComprasDTO $carrito, ProductoDTO $prod) {
        $items = $carrito->getItems();
        $c = 0;
        $in = 0;
        foreach ($items as $it) {
            $it instanceof ItemCarritoDTO;
            $proIt = $it->getProducto();
            $proIt instanceof ProductoDTO;
            if ($proIt->getIdProducto() == $prod->getIdProducto()) {
                $in = $c;
                break;
            }
            $c++;
        }
        return $in;
    }

}
