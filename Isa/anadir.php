<?php

require_once('include/sesiones.php');
require_once('include/CestaCompra.php');


// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
comprobar_sesion();

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Comprobamos si se quiere añadir un producto a la cesta
if (isset($_POST['añadir'])) {
    $codigo_producto=$_POST['cod'];
    $cesta->carga_articulo($_POST['cod'], $_POST['unidades']);
    $cesta->guarda_cesta();
}
$producto=$cesta->get_producto($codigo_producto);
$familia=$producto->get_familia();
header("Location:listado_productos.php?familia=".$familia);

