<?php
require_once '../Modelo/Producto.php';
require_once '../Modelo/DB.php';

class CestaCompra {

    //Atributo de la clase
    protected $carrito = [];

    //Getter
    public function get_carrito() {
        return $this->carrito;
    }

    //A esta función le mandamos el código y las unidades que se quieren añadir
    public function carga_articulo($unidades, $cod_prod) {
        //Si el producto ya existe, sumamos una unidad
        if (array_key_exists($cod_prod, $this->carrito)) {
            //Sumamos las unidades existentes más las nuevas         
            $this->carrito[$cod_prod]['unidades'] += $unidades;
        } else {
            //Si no existe, metemos el objeto producto(valor) con la clave producto y las unidades como valor con la clave unidades
            try {
                //Añadimos el producto como clase al array
                $this->carrito[$cod_prod]['producto'] = DB::obtieneProducto($cod_prod);
                //Le ponemos las unidades que le hemos pasado como parámetro
                $this->carrito[$cod_prod]['unidades'] = $unidades;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        //Devolvemos el carrito
        return $this->carrito;
    }

    //Devuelve el coste de los productos que figuran en la cesta
    public function get_coste() {
        $coste_total = 0; 
        //Recorremos el objeto, sumando las unidades
        foreach ($this->carrito as $producto) {
            $coste_total+=$producto['unidades']*$producto['producto']->getPvp();
        }
        
        return $coste_total;
    }

    //Devuelve el código de la familia asociado al producto de la cesta, cuyo código se pasa como parámetro
    public function get_familia($cod_prod) {
        return $this->carrito[$cod_prod]["producto"]->getFamilia();
    }

    //Devuelve true o false dependiendo de si la cesta está vacía o no
    public function is_vacia() {
        if (count($this->carrito) == 0) {
            return true;
        } else {
            return false;
        }
    }

    //Recupera el contenido de la cesta de la sesión o crearla si no existía
    /* Para llamarlo del programa, al ser static, hay que igualar la variable a 
      $cesta = CestaCompra::cargarCesta(); */
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) {
            //Si no existe, creamos un objeto CestaCompra
            $cesta = new CestaCompra();
        } else {
            //Recuperamos la cesta de la sesión
            $cesta = $_SESSION['cesta'];
        }
        //Devolvemos la cesta, ya sea la que estaba o la que hemos creado nueva
        return $cesta;
    }

    //Función para guardar la cesta en la Sessión
    //Para llamarla desde el programa $cesta->guarda_cesta();
    public function guarda_cesta() {
        $_SESSION['cesta'] = $this;
    }
    
    //Elimina las unidades indicadas y guarda la cesta modificada
    public function elimina_unidades($unidades, $cod_prod){
        //Compruebo si existe el código del producto
        if (array_key_exists($cod_prod, $this->carrito)){
            $unidades_anteriores = $this->carrito[$cod_prod]['unidades'];
            //Compruebo que las unidades que se quieren restar no sean mayores que las existentes
            if ($unidades_anteriores>$unidades){
                //Cambio las unidades
               $this->carrito[$cod_prod]['unidades'] -= $unidades;
            } else {
               unset($this->carrito[$cod_prod]);
            } 
        }
    }
  
    //Función para vaciar la cesta
    public function vacia_cesta() {
        $_SESSION["cesta"]= new CestaCompra();
        return $_SESSION["cesta"];
    }
    
}
