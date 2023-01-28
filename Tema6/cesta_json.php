<?php
require_once './CestaCompra.php';
require_once './funciones.php';
comprobar_sesion();

$cesta = CestaCompra::carga_cesta();
$cesta->get_carrito();

echo json_encode($cesta);

?>
