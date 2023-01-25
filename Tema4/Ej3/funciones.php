<?php 

//hacer funcion
function comprobarSesion(){
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.php?redirigido=true");
        }
}
function anadir_producto(&$cesta, $producto){
    
    if (array_key_exists($producto['cod'], $cesta)){
        $cesta[$producto['cod']]['unidades']++;
    }else{
        $cesta[$producto['cod']]= $producto;
    }
}

?>

