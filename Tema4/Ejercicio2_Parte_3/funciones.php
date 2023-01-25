<?php 

//hacer funcion
function comprobarSesion(){
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?redirigido=true");
        }
}

?>
