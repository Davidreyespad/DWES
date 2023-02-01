<?php
//Comprobar si tengo sesion
require_once '../Servicio/funciones.php';
require_once '../Servicio/CestaCompra.php';
comprobarSesion();

//Comprobamos si hay cesta creada, sino la creamos
$cesta = CestaCompra::carga_cesta();

//Recojo los datos del formulario
if (isset($_POST['unidades_modif'])){
    $unidades = $_POST['unidades_modif'];
}
if (isset($_POST['cod_modif'])){
    $cod_prod = $_POST['cod_modif'];
}

//Llamo al método, pasándole las unidades seleccionadas y el código del producto
$cesta->elimina_unidades($unidades, $cod_prod);

//Guardamos la cesta en la sesión
$cesta->guarda_cesta();

//Lo redirecciono a la página de Login para que inicie sesión
header('Location: ../Vista/cesta_vista.php');

