<?php
require_once('include/CestaCompra.php');
require_once('include/sesiones.php');

// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
comprobar_sesion();

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Obtenemos los datos necesarios
$usuario = $_SESSION['usuario'];
$productoscesta = $cesta->get_productos();
$coste = $cesta->get_coste();

// Incluimos el fichero de la vista para presentar los datos
require_once('vista/vista_cesta.php');