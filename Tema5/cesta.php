<?php
require_once './CestaCompra.php';
require_once './DB.php';
require_once './funciones.php';



$cesta = CestaCompra::carga_cesta();

print_r($cesta);

?>

