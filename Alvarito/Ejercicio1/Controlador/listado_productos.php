<?php

require_once '../Modelo/DB.php';
require_once '../Servicio/CestaCompra.php';
require_once '../Servicio/funciones.php';

//Cerrar Sesión
if (isset($_POST['desconectar'])) {
    desconectame();
}

//Comprobar si tengo sesion
comprobarSesion();

//Comprobamos si hay cesta creada, sino la creamos
$cesta = CestaCompra::carga_cesta();

//Comprobamos si se ha pulsado en vaciar cesta
if (isset($_POST['vaciar'])) {
    $cesta = $cesta->vacia_cesta();
}

//Capturo el contenido del link que viene de listado_familias o de pulsar el botón de vaciar carrito
if (isset($_REQUEST['familia'])) {
    //htmlspecialchars es para que no nos inyecten código
    $cod_familia = htmlspecialchars($_REQUEST['familia']);
    $_SESSION['familia']= $cod_familia;
    
} else if (isset($_SESSION['familia'])){
    $cod_familia = $_SESSION['familia'];
}else{
    //En caso de que hayamos llegado a la página sin seleccionar familia, mostramos mensaje con enlace a listado_familia
    $mensaje_sin_familia = "No ha seleccionado ninguna familia, seleccione una <a href='../Vista/listado_familias_vista.php'>Familia</a>";
}

//Consulta a la BD para obtener todos los productos de una familia
//Importante hacerlo dentro de un try catch
if (isset($cod_familia)) {
    try {
        $array_productos = DB::obtieneProductos($cod_familia);
        if (count($array_productos) == 0) {
            $mensaje_sin_productos = "No tenemos productos de esta familia, seleccione otra <a href='../Vista/listado_familias_vista.php'>Familia</a>";
        }
    } catch (Exception $ex) {
        $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
    }
}

//Si se ha pulsado añadir
if (isset($_POST['anadir'])) {
    //Recogemos los datos hidden del formulario
    $cod_prod = htmlspecialchars($_POST['cod']);

    //Capturo las unidades que se han colocado en el input
    $unidades = htmlspecialchars($_POST['unidades']);

    //Ahora utilizo la función pasándole como parámetros las unidades y el código del producto
    $cesta->carga_articulo($unidades, $cod_prod);

    //IMPORTANTE GUARDAR LA CESTA EN LA SESIÓN
    $cesta->guarda_cesta();
}

//Comprobamos si la cesta está vacía (Como es un objeto, tenemos que acceder a su atributo carrito
$cesta_vacia = $cesta->is_vacia();
?>

