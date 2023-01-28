<?php
//Comprobar si tengo sesion
require_once './CestaCompra.php';
require_once './DB.php';
require_once './funciones.php';
require_once './Producto.php';

comprobar_sesion();

$cesta = CestaCompra::carga_cesta();
$cesta = new CestaCompra();

if (isset($_POST['vaciar'])) {
    $cesta->vaciar_cesta();
    $cesta->guardar_cesta();
}

$cesta_vacia = $cesta->is_vacia();
$prod_cesta = $cesta->get_productos();

$mensaje_excepcion = "";
$cod_familia = "";

if (isset($_REQUEST['familia'])) {
    $cod_familia = htmlspecialchars($_REQUEST['familia']);
    $_SESSION['familia'] = $cod_familia;
} else if (isset($_SESSION['familia'])) {
    $cod_familia = $_SESSION['familia'];
}
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de productos</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>

            <!-- Dividir en varios templates -->
            <div id="cesta">      
                <h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
                <hr/>
                <?php if ($cesta_vacia): ?>
                    <h3>Cesta vacía</h3>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                            <th>Unidades</th>
                        </tr>
                        <?php foreach ($cesta as $prod): ?>
                            <tr>
                                <td><?= $prod["producto"]->getnombre ?></td>
                                <td>x</td>
                                <td><?= $prod["unidades"] ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                <?php endif ?>
                <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>

                    <input type='submit' name='vaciar' value='Vaciar Cesta'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                    <input type='hidden' name='familia' value='<?= $familia ?>'/>

                </form>
                <form id='comprar' action='cesta.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                </form>
            </div>

            <div id="productos">
                <table>
                    <tr>
                        <th>Añadir</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>PVP</th>
                    </tr>  
                    <?php if (isset($productos) && count($productos) > 0): ?>
                        <tr>
                            <td>
                                <form id='anadir' action='listado_productos.php?familia=<?= $familia ?>' method='post'>
                                    <input type='submit' name='anadir' value='Añadir'/>
                                    <input type='hidden' name='cod' value='<?= $value->cod ?>'/>
                                    <input type='hidden' name='nombre_corto' value='<?= $value->nombre_corto ?>'/>
                                    <input type='hidden' name='PVP' value='<?= $value->PVP ?>'/>
                                    <input type='hidden' name='familia' value='<?= $value->familia ?>'/>
                                </form>
                            </td>
                            <td><?= $value->nombre_corto ?></td>
                            <td><?= $value->descripcion ?></td>
                            <td><?= $value->PVP ?>€</td>
                        </tr>
                    <?php endif; ?>

                </table>

            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_familias.php">Ir a Listado Familias</a>
                <br>
                <a href="cesta.php">Ir a Cesta</a>
                <form action='cesta.php' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario'/>
                </form>  
            </div>
        </div>

        <?php if (isset($mensaje_catch)): ?>
            <div id="mensaje_error">
                <p class="error"><?= $mensaje_catch ?></p>
            </div>
        <?php endif ?>
    </body>
</html>
