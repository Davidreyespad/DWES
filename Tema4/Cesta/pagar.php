<?php
//Comprobar si tengo sesion
require_once 'funciones.php';
comprobarSesion();

//Recuperamos la cesta
$cesta = cargarCesta();
//Nombre de Usuario
$usuario = $_SESSION['usuario'];

//Si la cesta está vacía, redireccionamos a listado familias
if (count($cesta) == 0) {
    header('Location: listado_familias.php?redireccionado_cesta=true');
}
//Vaciamos la cesta y la Session Cesta
 $cesta = [];
 $_SESSION['cesta'] = [];
die("Gracias por su compra.<br/> ¿Quiere <a href='listado_familias.php'>Comenzar de nuevo</a>?");
?>




