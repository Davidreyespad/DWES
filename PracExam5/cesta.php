<?php

require_once './CestaCompra.php';
require_once './DB.php';
require_once './funciones.php';

comprobarSesion();

$cesta = CestaCompra::carga_cesta();


if($cesta->is_vacia()){
    header('Location: listado_familia?cesta_vacia=true');
}

if(isset($_POST['pagar'])){
    $cesta->vacia_cesta();
    header ('Location: pagado.php?pagado=true');
}

if (isset($_POST['desconectar'])){
    desconectarme();
}

$coste_total = $cesta->get_coste();
?>

<!DOCTYPE html>
<html>
   <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Cesta de la Compra</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagcesta">
       

        <div id="contenedor">
            <div id="encabezado">
                
                <h1><img src='../icono/cesta.png' alt='Cesta' width='40' height='40'> Cesta de la compra <?php if (isset($_SESSION['usuario'])): ?>
                        de <?= ucfirst($_SESSION['usuario']) ?>
                    <?php endif ?></h3></h1>
            </div>
            <div id="productos">
                <table border="1">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Eliminar Productos</th>
                        <th>Importe</th>
                    </tr>
                   
                        <?php foreach ($cesta->get_carrito() as $producto): ?>
                        <tr>
                            <td><?= $producto['producto']->getNombre_corto() ?></td>
                            <td><?= $producto['producto']->getPvp() ?></td>
                            <td><?= $producto['unidades']?></td>
                            <td>
                                <form id='modificar' action='eliminar.php' method='post'>
                                    <input type="number" name='unidades_modif' value="0" class="cantidad"></input>
                                    <input type='submit' name='eliminar_unidades' class='eliminar' value='X'/>
                                    <input type='hidden' name='cod_modif' value='<?= $producto['producto']->getCod()?>'/>
                                </form>
                            </td>
                            <td><?=$producto['producto']->getPvp()*$producto['unidades']?> €</td>
                            </tr>
                        <?php endforeach; ?>

                </table>
                <hr/>
                <p><span class='pagar'>Precio total: <?= $coste_total ?> €</span></p>
                <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                    <p>
                        <span class='pagar'>
                            <input type='submit' name='pagar' value='Pagar'/>
                        </span>
                    </p>
                </form>
            </div>
            <br class="divisor" />
            <div id="pie">
                <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario' class="desconectar"/>
                </form>        
            </div>
             <div id="pie">
                <a href="listado_familias.php">Ir a Listado Familias</a>
                <br>
                <a href="listado_productos.php">Ir a Listado Productos</a>
            </div>
        </div>
    </body>
</html>
