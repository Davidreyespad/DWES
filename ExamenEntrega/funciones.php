<?php

function comprobarUsuario() {

    session_start();

    if (!isset($_SESSION['usuario'])) {
        $_SESSION['sesion'] = [];
    }
    
    header('Location: ./login.php?devuelto=true');
}

function comprobarSesion() {

    session_start();

    if (!isset($_SESSION['usuario'])) {
        $_SESSION['usuario'] = [];
    }
    
    header('Location: ./login.php?devuelto=true');
    
} 
?>

