<?php
    require_once('include/sesiones.php');
    require_once('include/DB.php');
    require_once('include/CestaCompra.php');

    // Recuperamos la información de la sesión
    // Y comprobamos que el usuario se haya autentificado
    comprobar_sesion();
    
    // Obtenemos los datos de la sesión
    $usuario = $_SESSION['usuario'];
    $cesta = CestaCompra::carga_cesta();

    //Insertamos el pedido en la BD
    $codped=DB::insertaPedido($cesta, $usuario);
      
    if ($codped){
        //Se elimina la cesta de la sesión del usuario
        unset($_SESSION['cesta']);
        die("Gracias por su compra.<br/>Quiere <a href='listado_familias.php'>comenzar de nuevo</a>? O prefiere <a href='logout.php'>salir</a>");
    }else{
        die("Error al procesar el pedido. <br/>Quiere <a href='listado_familias.php'>comenzar de nuevo</a>? O prefiere <a href='logout.php'>salir</a>");
    }
