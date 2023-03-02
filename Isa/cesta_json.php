<?php
require_once('include/CestaCompra.php');
require_once('include/sesiones.php');
require_once 'include/DB.php';
require_once 'include/Producto.php';

comprobar_sesion();

$cesta = CestaCompra::carga_cesta();

echo "hola";
echo json_encode($cesta->get_productos());