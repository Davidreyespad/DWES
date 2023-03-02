<?php
require_once('include/CestaCompra.php');
require_once('include/sesiones.php');
require_once 'include/DB.php';

comprobar_sesion();

$cesta = CestaCompra::carga_cesta();

if(isset($__POST['codigo'])){
    $codigo = $_POST['codigo'];
}

if(isset($__POST['unidades'])){
    $codigo = $_POST['unidades'];
}

$cesta->elimina_unidades($codigo, $unidades);

$cesta->guarda_cesta();