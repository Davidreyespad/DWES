<?php

// Incluimos los ficheros de clases y acceso a bases de datos
require_once('include/DB.php');
require_once('include/CestaCompra.php');
require_once('include/sesiones.php');
require_once('include/Producto.php');

// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
comprobar_sesion();

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

//Devolvemos la cesta serializada
echo json_encode($cesta->get_productos());




