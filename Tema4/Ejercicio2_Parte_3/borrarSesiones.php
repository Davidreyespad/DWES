<?php
require_once './funciones.php';

comprobarSesion();

if (isset($_POST['borrarSesion'])) {
   
    if (isset($_SESSION['visitas'])) {
               
            unset($_SESSION['visitas']);
            $_SESSION['visitas']=[];  
            
    }      
}

header("Location: sesiones.php?borrar=true");

?>

