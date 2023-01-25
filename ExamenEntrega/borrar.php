<?php
require_once './funciones.php';

comprobarSesion();

if (isset ($_SESSION['borrar'])) {
    
    if (isset ($_COOKIE['visita'])) {
        unset($_SESSION['visita']);
    }
}
?>

