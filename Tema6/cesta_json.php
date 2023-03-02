<?php
require_once 'CestaCompra.php';
require_once 'funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

print_r("hola");

echo json_encode($cesta->get_carrito(), true);


