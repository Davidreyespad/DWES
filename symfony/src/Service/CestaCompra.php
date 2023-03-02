<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Producto;

class CestaCompra {

    protected $carrito = [];
    protected $sesion;
    protected $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
        $this->sesion = $requestStack->getCurrentRequest()->getSession();
        $this->cargarCesta();
    }

    public function guardarCesta() {
        $this->sesion->set('cesta', $this->carrito);
    }

    public function cargarCesta() {
        if ($this->sesion->has('cesta')) {
            $this->carrito = $this->sesion->get('cesta');
        } else {
            $this->guardarCesta();
        }
    }

    public function precioTotal() {
        $precioTotal = 0;
        foreach ($this->carrito as $cod => $prod) {
            $precio = $prod['producto']->getPrecio();
            $unidades = $prod['unidades'];
            $precio_producto = $precio * $unidades;
            $precioTotal += $precio_producto;
        }
        return $precioTotal;
    }

    public function getProductos() {
        return $this->carrito;
    }

    public function anadirArticulo($unidades, Producto $producto) {
        $codigo_producto = $producto->getCod();

        if (array_key_exists($codigo_producto, $this->carrito)) {
            $this->carrito[$codigo_producto]['unidades'] += $unidades;
        } else {
            $this->carrito[$codigo_producto]['unidades'] = $unidades;
            $this->carrito[$codigo_producto]['producto'] = $producto;
        }
    }

    public function eliminarUnidades($unidades, Producto $producto) {
        $codigo_producto = $producto->getCod();

        if (array_key_exists($codigo_producto, $this->carrito)) {
            $unidades = intval($this->carrito[$codigo_producto]['unidades']);

            if ($unidades <= 1) {
                unset($this->carrito[$codigo_producto]);
            } else {
                $this->carrito[$codigo_producto]['unidades'] = intval($this->carrito[$codigo_producto]['unidades'])- 1;
            }
        }
    }
    
    public function borrarCesta(){
        $this->carrito = [];
    }

}
