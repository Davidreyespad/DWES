<?php
require_once 'CestaCompra.php';
require_once 'funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();
$cesta->get_carrito();

echo json_encode($cesta);


