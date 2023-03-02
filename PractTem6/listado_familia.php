<?php
require_once './DB.php';
require_once './Familia.php';
require_once './CestaCompra.php';
require_once './funciones.php';

comprobarSesion();

if (isset($_POST['desconectar'])) {
    desconectarme();
}

$cesta = CestaCompra::carga_cesta();

if (isset($_POST['vaciar'])) {
    $cesta = $cesta->vacia_cesta();
}

if (isset($_REQUEST['redirigido_sin_familia'])){
    $mensaje_redirigido_sin_familia = "Debe seleecionar una familia";
}

if(isset($_REQUEST['cesta_vacia'])){
    $mensaje_cesta_vacia = "Cesta vacía";
}

$cesta_vacia = $cesta->is_vacia();

try{
    $array_familias = DB::obtieneFamilias();
} catch (PDOException $ex) {
    $mensaje_catch = "Ha ocurrido un error: " .$ex->getMessage();
}


?>

<!DOCTYPE html>
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
            <div>
<?php
//CONTROLAMOS QUE NO VENGA REDIRIGIDO
if (isset($mensaje_redirigido_sin_familia)):
    ?>
                    <p class="error"><?= $mensaje_redirigido_sin_familia ?></p>
                <?php endif ?>
                <?php if (isset($mensaje_cesta_vacia)): ?>
                    <p class="error"><?= $mensaje_cesta_vacia ?></p>
                <?php endif ?>   
                <?php if (isset($mensaje_sin_sesion)): ?>
                    <p class="error"><?= $mensaje_sin_sesion ?><p>
                <?php endif ?>
                    <?php if (isset($mensaje_catch)): ?>
                    <p class="error"><?= $mensaje_catch ?></p>
                    <?php endif ?>
            </div>

            <div id="cesta">      
                <h3><img src='cesta.png' alt='Cesta' width='40' height='40'> Cesta 
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
 <li> <a href="./listado_productos.php?familia=<?= $familia->get_cod() ?>"><?= $familia->get_nombre() ?></a></li> 
 <!-- <li> <a href="productos_json.php?familia=<?= $familia->get_cod() ?>" onclick="cargarProductos(this); return false"><?= $familia->get_nombre() ?></a></li> -->
                    <?php endforeach ?>
                </ul> 
            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_productos.php">Ir a Listado Productos</a>
                <br>
                <a href="cesta.php">Ir a Cesta</a>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario' class="desconectar"/>
                </form> 
            </div>
        </div>
    </body>
</html>