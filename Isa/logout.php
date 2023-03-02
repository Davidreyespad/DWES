<?php
    require_once 'include/sesiones.php';	
    
    // Recuperamos la información de la sesión
    // comprobando su existe la variable usuario
    comprobar_sesion();
    
    // Y la eliminamos
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 123, time() - 1000); // eliminar la cookie
    header("Location: login.php");
?>
