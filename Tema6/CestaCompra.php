<?php

require_once ('./DB.php');
require_once ('./Producto.php');
require_once ('./familia.php');

class CestaCompra {

    protected $carrito = [];

    public function carga_articulo($unidades, $codigo) {
        if (array_key_exists($codigo, $this->carrito)) {
            $this->carrito[$codigo]['unidades'] += $unidades;
        } else {
            try {
                $this->carrito[$codigo]['producto'] = DB::obtieneProducto($cod_prod);
                $this->carrito[$codigo]['unidades'] = $unidades;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        return $this->carrito;
    }

    public function get_productos() {
        return $this->carrito;
    }

    public function get_unidades() {
        return $this->carrito;
    }

    public function get_coste() {
        $coste = 0;
        foreach ($this->carrito as $producto) {
            $coste += $producto['unidades']*$producto['producto']->getPvp();
        }
        return $coste;
    }

    public static function get_familia($codigo) {
        return $this->carrito[$codigo]["producto"]->getFamilia();
    }

    public function guardar_cesta() {
        $_SESSION["cesta"] = $this;
    }
    
    public function get_carrito() {
        return $this->carrito;
    }

    public function is_vacia() {
        if (count($this->carrito) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function carga_cesta() {
        if (isset($_SESSION["cesta"])) {
            $cesta = $_SESSION['cesta'];
        } else {
            $_SESSION['cesta'] = [];
            $cesta = new CestaCompra();
        }
        return $cesta;
    }

    public static function vaciar_cesta() {
        $_SESSION["cesta"]= new CestaCompra();
        return $_SESSION["cesta"];
    }

}
