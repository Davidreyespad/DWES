<?php

require_once './Producto.php';

function comprobarSesion() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php?redirigido=true');
    }
}


function desconectarme(){
    //Destruimos variables sesion
    $_SESSION = array();
    
    session_destroy();
    
    header('Location: login.php?logout=true');
}