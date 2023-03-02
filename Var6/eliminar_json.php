<?php

// Incluimos los ficheros de clases y acceso a bases de datos
require_once('include/DB.php');
require_once('include/CestaCompra.php');
require_once('include/sesiones.php');

// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
comprobar_sesion();
// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

//Recuperamos los datos enviados por la petición
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
}
if (isset($_POST['unidades'])) {
    $unidades = $_POST['unidades'];
}

//Eliminamos las unidades del producto pasándolo 
$cesta->elimina_unidades($codigo, $unidades);

//Importante guardar la cesta en la sesión de nuevo
$cesta->guarda_cesta();