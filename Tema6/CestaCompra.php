<?php

require_once './DB.php';
require_once './Producto.php';

class CestaCompra {

    protected $carrito = [];

    public function get_carrito() {
        return $this->carrito;
    }

    public function carga_articulo($unidades, $cod_prod) {
        if (array_key_exists($cod_prod, $this->carrito)) {
            $this->carrito[$cod_prod]['unidades'] += $unidades;
        } else {
            try{
                $this->carrito[$cod_prod]['producto'] = DB::obtieneProducto($cod_prod);
                $this->carrito[$cod_prod]['unidades'] = $unidades;
            } catch (PDOException $ex) {
                throw $ex;
            }
        }
        return $this->carrito;
    }
    
    public function get_coste() {
        $coste_total = 0;
        
        foreach ($this->carrito as $producto) {
            $coste_total+=$producto['unidades'] * $producto['producto']->getPvp();
        }
        
        return $coste_total;
    }
    
    public function get_familia($cod_prod) {
        return $this->carrito[$cod_prod]['producto']->getFamilia();
    }
    
    public function is_vacia() {
        if (count($this->carrito) == 0){
            return true;
        }else{
            return false;
        }
    }    
    
    public static function carga_cesta() {
        if(!isset($_SESSION['cesta'])){
            $cesta = new CestaCompra();
        }else{
            $cesta = $_SESSION['cesta'];
        }
        return $cesta;
    }
    
    public function guarda_cesta(){
        $_SESSION['cesta'] = $this;
    }
    
    public function elimina_unidades($unidades, $cod_prod){
        
        if(array_key_exists($cod_prod, $this->carrito)){
            $unidades_anteriores = $this->carrito[$cod_prod]['unidades'];
            if($unidades_anteriores>$unidades){
                $this->carrito[$cod_prod]['unidades'] -= $unidades;
            }else{
                unset($this->carrito[$cod_prod]);
            }
        }
    }
    
    public function vacia_cesta(){
        $_SESSION["cesta"] = new CestaCompra();
        return $_SESSION["cesta"];
    }
    

}
