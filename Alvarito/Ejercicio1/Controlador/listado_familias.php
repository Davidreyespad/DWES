<?php
require_once '../Modelo/DB.php';
require_once '../Servicio/CestaCompra.php';
require_once '../Servicio/funciones.php';

//Comprobar si tengo sesion
comprobarSesion();

//Cerrar Sesión
if (isset($_POST['desconectar'])) {
desconectame();
}

//Cargamos la cesta en la variable que creamos para utilizarla
$cesta = CestaCompra::carga_cesta();

//Comprobamos si se ha pulsado en vaciar cesta
if (isset($_POST['vaciar'])){
    $cesta = $cesta->vacia_cesta();
}

//Compruebo si viene redirigido de listado_productos_vista
if (isset($_REQUEST['redirigido_sin_familia'])) {
    $mensaje_redirigido_sin_familia = 'Debe usted seleccionar previamente alguna familia para acceder al listado de productos.';
}
//Compruebo si viene redirigido de cesta_vista
if (isset($_REQUEST['cesta_vacia'])) {
    $mensaje_cesta_vacia = 'Su cesta está vacía, debe elegir al menos un producto para continuar.';
}

//Comprobamos si la cesta está vacía (Como es un objeto, tenemos que acceder a su atributo carrito
$cesta_vacia = $cesta->is_vacia();

//Hacemos la consulta de familia
try{
    $array_familias = DB::obtieneFamilias();
} catch (Exception $ex) {
    $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
}

                       
?>
