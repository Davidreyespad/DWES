<?php

require_once './CestaCompra.php';
require_once './DB.php';
require_once './funciones.php';

comprobarSesion();

if(isset($_REQUEST['familia'])){
    $cod_familia = $_REQUEST['familia'];
}

$array_productos = DB::obtieneProductos($cod_familia);

$json = json_encode($array_productos, true);
echo $json;

?>