<?php
require_once '/home/dreypad/NetBeansProjects/DWES/Tema6/Servicio/CestaCompra.php';
require_once '/home/dreypad/NetBeansProjects/DWES/Tema6/Servicio/funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();
$cesta->get_carrito();

echo json_encode($cesta);


