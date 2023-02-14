<?php

require_once './funciones.php';
require_once './CestaCompra.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

if (isset($_POST['unidades_modif'])) {
    $unidades = $_POST['unidades_modif'];
}
if (isset($_POST['cod_modif'])) {
    $cod_prod = $_POST['cod_modif'];
}

$cesta->elimina_unidades($unidades, $cod_prod);

$cesta->guarda_cesta();

header ('Location: cesta.php');
