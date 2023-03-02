<?php
require_once 'CestaCompra.php';
require_once 'funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

print_r($cesta);


?>

