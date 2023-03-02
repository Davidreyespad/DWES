<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Product;

class CestaCompra {

    protected $carrito = [];
    protected $sesion;
    protected $requestStack;
    
    public function __construct(RequestStack $requestStack) {
        $this->requestStack= $requestStack;
        $this->sesion = $requestStack->getCurrentRequest()->getSession();
        $this->cargarCesta();        
    }
    
    public function guardarCesta(){
        $this->sesion->set('cesta', $this->carrito);
    }
    
    public function cargarCesta(){
        if($this->sesion->has('cesta')){
            $this->carrito=$this->sesion->get('cesta');
        }else{
            $this->guardarCesta();
        }
    }
    
    public function precioTotal(){
        $precioTotal = 0;
        foreach($this->carrito as $cod=>$prod){
            $precio = $prod['producto']->getPrecio();
            $unidades = $prod['unidades'];
            $producto_total = $precio * $unidades;
            $precioTotal += $producto_total;
        }
        return $precioTotal;
    }
    
    public function getProductos(){
        return $this->carrito;
    }

}
