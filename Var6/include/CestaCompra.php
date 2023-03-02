<?php
require_once('DB.php');

class CestaCompra {
    protected $productos = array();
    
    // Introduce un nuevo artículo en la cesta de la compra
    public function carga_articulo($codigo, $unidades){
        if(array_key_exists($codigo, $this->productos)){
            $this->productos[$codigo]['unidades'] += $unidades;
        }else{
            $this->productos[$codigo]['producto']=DB::obtieneProducto($codigo);
            $this->productos[$codigo]['unidades']=$unidades;
        }
    }
    
    // Obtiene un objeto Producto de la cesta a partir del código
    public function get_producto($codigo){
        $producto=null;
        if(array_key_exists($codigo, $this->productos)){
            $producto=$this->productos[$codigo]['producto'];
        }
        return $producto;
    }
    
    //Elimina el número de unidades de un producto, borrando el producto
    // de la cesta en el caso de que resulte con 0 o menos unidades.
    public function elimina_unidades($codigo, $unidades){
    // Si existe el código, restamos las unidades, con mínimo de 0
        if(array_key_exists($codigo, $this->productos)){
            $this->productos[$codigo]['unidades'] -= $unidades;
            if($this->productos[$codigo]['unidades'] <= 0){
                unset($this->productos[$codigo]);
            }
        }
    }
    
    // Obtiene los artículos en la cesta
    public function get_productos() { return $this->productos; }
    
    // Obtiene el coste total de los artículos en la cesta
    public function get_coste() {
        $coste = 0;
        foreach($this->productos as $p) $coste += $p['producto']->get_PVP() * $p['unidades'];
        return $coste;
    }
    
    // Devuelve true si la cesta está vacía
    public function is_vacia() {
        if(count($this->productos) == 0) return true;
        return false;
    }
    
    // Guarda la cesta de la compra en la sesión del usuario
    public function guarda_cesta() { $_SESSION['cesta'] = $this; }
    
    // Recupera la cesta de la compra almacenada en la sesión del usuario
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) return new CestaCompra();
        else return ($_SESSION['cesta']);
    }
    
    // Muestra el HTML de la cesta de la compra, con todos los productos
    public function muestra() {
       // Si la cesta está vacía, mostramos un mensaje
       if (count($this->productos)==0){
           print "<p>Cesta vacía</p>";
       }
       //  y si no está vacía, mostramos su contenido
       else{
           foreach ($this->productos as $arrayProductoUnidades){
               echo"<p>". $arrayProductoUnidades['producto']->get_nombre_corto()." x ". $arrayProductoUnidades['unidades']. " unidades</p>";
           }
       }
    }
    
}
