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

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
    // Se inicializa la cesta
    $cesta = new CestaCompra();
}

// Obtenemos los datos necesarios
$usuario = $_SESSION['usuario'];
$familias = DB::obtieneFamilias();
$productoscesta = $cesta->get_productos();

// Incluimos el fichero de la vista para presentar los datos
require_once('vista/vista_listado_familias.php');
