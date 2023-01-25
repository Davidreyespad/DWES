<?php

require_once ('./DB.php');
require_once ('./Producto.php');
require_once ('./familia.php');

class CestaCompra {

    protected $carrito = [];
    protected $productos;
    protected $unidades;

    public function carga_articulo($codigo, $unidades) {

        if (array_key_exists($codigo, $this->productos)) {
            $numero_unidades = $this->unidades[$codigo];
            $numero_unidades += $unidades;
            $this->unidades[$codigo] = $numero_unidades;
        } else {
            try {
                $producto = DB::obtieneProducto($codigo);
                $this->productos[$codigo] = $producto;
                $this->unidades[$codigo] = $unidades;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function get_productos() {
        return $this->productos;
    }

    public function get_unidades() {
        return $this->unidades;
    }

    public function get_coste() {
        $coste = 0;
        foreach ($this->carrito as $producto) {
            $coste += $producto->getPVP();
        }
        return $coste;
    }

    public static function get_familia($cod_prod) {
        
    }

    public function guardar_cesta() {
        $_SESSION['cesta'] = $this;
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
        
    }

}
