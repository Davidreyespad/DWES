<?php
//Comprobar si tengo sesion
require_once './funciones.php';
require_once './CestaCompra.php';
comprobar_sesion();

$cesta = CestaCompra::carga_cesta();

if (isset($_POST['vaciar'])){
    $cesta = $cesta->vacia_cesta();
}

try {
    $array_familias = DB::obtieneFamilias();
} catch (Exception $ex) {
    $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
}
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de familias</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de familias</h1>
            </div>
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
                </form>
                <form id='comprar' action='cesta.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>

                </form>

            </div>

            <!--Lista de vínculos con la forma listado_productos.php?categoria=-->
            <div id="productos">
                <h3>Seleccione una familia:</h3>
                <ul >
                    <?php foreach ($array_familias as $familia): ?>
                        <li> <a href="listado_productos.php?familia=<?= $familia->get_cod() ?>"><?= $familia->get_nombre() ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_productos.php">Ir a Listado Productos</a>
                <br>
                <a href="cesta.php">Ir a Cesta</a>

            </div>
        </div>
        <?php if (isset($mensaje_catch)): ?>
            <div id="mensaje_error">
                <p class="error"><?= $mensaje_catch ?></p>
            </div>
        <?php endif ?>
    </body>
</html>