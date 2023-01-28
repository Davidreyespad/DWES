<?php
require_once './CestaCompra.php';

require_once './funciones.php';
comprobar_sesion();

$cesta = CestaCompra::carga_cesta();

//Recoger parametros
if(isset($_POST['enviar'])){
    $codigo_producto = $_POST['codigo'];
    $unidades = $_POST['unidades'];
    
    //Meto articulo
    $cesta->carga_articulo($codigo, $unidades);
    
    //Guardo en la cesta
    $cesta->guardar_cesta();
    
}


?>