<?php
require_once '../Servicio/CestaCompra.php';
require_once '../Modelo/DB.php';
require_once '../Servicio/funciones.php';
//Comprobar si tengo sesion

comprobarSesion();

//Comprobamos si hay cesta creada, sino la creamos
$cesta = CestaCompra::carga_cesta();

//Si hemos llegado hasta aquí con la cesta vacía, nos redirige a listado_familias_vista.php
if ($cesta->is_vacia()) {
    header('Location: ../Vista/listado_familias_vista.php?cesta_vacia=true');
}

//Compruebo si vengo de pulsar el botón pagar
if (isset($_POST['pagar'])) {
    $cesta->vacia_cesta();
    header('Location: ../Controlador/pagado.php?pagado=true');
}

//Compruebo si vengo de pulsar el botón cerrar sesión
if (isset($_POST['desconectar'])) {
    desconectame();
}

//Variable para el coste total de la cesta
$coste_total = $cesta->get_coste();


