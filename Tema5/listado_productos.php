<?php
require_once './DB.php';
require_once './CestaCompra.php';
require_once './funciones.php';
require_once './Producto.php';

if (isset($_POST['desconectar'])) {
    desconectarme();
}

comprobarSesion();

$cesta = CestaCompra::carga_cesta();

if (isset($_POST['vaciar'])) {
    $cesta = $cesta->vacia_cesta();
}

if (isset($_REQUEST['familia'])) {
    $cod_familia = htmlspecialchars($_REQUEST['familia']);
    $_SESSION['familia'] = $cod_familia;
} else if (isset($_SESSION['familia'])) {
    $cod_familia = $_SESSION['familia'];
} else {
    $mensaje_sin_familia = "No ha seleccionado familia";
}

if(isset($cod_familia)){
    try{
        $array_productos = DB::obtieneProductos($cod_familia);
        if(count($array_productos) == 0){
            $mensaje_sin_productos = "No hay productos de esta familia";
        }
    } catch (Exception $ex) {
        $mensaje_catch = "error" .$ex->getMessage();
    }
}

if(isset($_POST['anadir'])){
    $cod_prod = htmlspecialchars($_POST['cod']);
    
    $unidades = htmlspecialchars($_POST['unidades']);
    
    $cesta->carga_articulo($unidades, $cod_prod);
    
    $cesta->guarda_cesta();
}

$cesta_vacia = $cesta->is_vacia();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de Productos</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body class="pagproductos">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>

            <!-- Dividir en varios templates -->
            <div id="cesta">      
                <h3><img src='cesta.png' alt='Cesta' width='40' height='40'>  Cesta 
<?php if (isset($_SESSION['usuario'])): ?>
                        de <?= ucfirst($_SESSION['usuario']) ?>
                    <?php endif ?></h3>
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

    <?php foreach ($cesta->get_carrito() as $prod): ?>
                            <tr>
                                <td><?= $prod["producto"]->getNombre_corto() ?></td>
                                <td>x</td>
                                <td><?= $prod["unidades"] ?></td>
                            </tr>
    <?php endforeach; ?>

                    </table>
<?php endif ?>
                <form id='vaciar' action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>

                    <input type='submit' name='vaciar' value='Vaciar Cesta'
<?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                    <input type='hidden' name='familia' value='<?= $cod_familia ?>'/>

                </form>
                <form id='comprar' action='cesta.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
<?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                </form>
            </div>

            <div id="productos">
<?php if (isset($mensaje_sin_productos)): ?>
                    <h3><?= $mensaje_sin_productos ?></h3>
                <?php else: ?>
                    <?php if (isset($array_productos)): ?>
                        <table>
                            <tr>
                                <th>Añadir</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>PVP</th>
                            </tr> 
        <?php foreach ($array_productos as $producto): ?>
                                <tr>
                                    <td>
                                        <form id='anadir' action='listado_productos.php?familia=<?= $cod_familia ?>' method='post'>
                                            <input type="number" name='unidades' value='1' class="cantidad">
                                            <input type='submit' name='anadir' value='Añadir'/>
                                            <input type='hidden' name='cod' value='<?= $producto->getCod() ?>'/>
                                        </form>
                                    </td>
                                    <td><?= $producto->getNombre_corto() ?></td>
                                    <td><?= $producto->getDescripcion() ?></td>
                                    <td><?= $producto->getPvp() ?>€</td>
                                </tr>
        <?php endforeach; ?>

                        </table>
    <?php else: ?>
                        <h3><?= $mensaje_sin_familia ?></h3>
                    <?php endif ?>
                <?php endif ?>
            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_familia.php">Ir a Listado Familias</a>
                <br>
                <a href="cesta.php">Ir a Cesta</a>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario' class="desconectar"/>
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
