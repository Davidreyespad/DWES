<?php

//Script para comprobar que se ha iniciado sesión
function comprobarSesion() {
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header('Location: login.php?redirigido_cesta=true');
    }
}

//Script que devuelve la cesta de la sesión o la crea
function cargarCesta() {
    if (!isset($_SESSION["cesta"])) {
        $_SESSION['cesta'] = [];
    }
    
    return $_SESSION['cesta'];
}


//Función para añadir el producto que hemos seleccionado pulsando añadir
function anadir_producto(&$cesta, $producto){
    
    if (array_key_exists($producto['cod'], $cesta)){
        $cesta[$producto['cod']]['unidades']++;
    }else{
        $cesta[$producto['cod']]= $producto;
    }
}


?>

