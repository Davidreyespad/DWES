<?php
require_once 'CestaCompra.php';
require_once 'funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

//Recoger parametros
if(isset($_POST['enviar'])){
    $codigo_producto = $_POST['codigo'];
    $unidades = $_POST['unidades'];
    
    //Meto articulo
    $cesta->carga_articulo($codigo_producto, $unidades);
    
    //Guardo en la cesta
    $cesta->guardar_cesta();
    
    console.log("hola");
    print_r("hola2");    
}

$array_productos=$cesta->get_producto($codigo_producto);

$cod_familia= $array_productos->get_familia();

header("Location:listado_productos.php?familia=" .$cod_familia);


?>