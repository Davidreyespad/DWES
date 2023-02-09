<?php
require_once '../Controlador/listado_productos.php';
require_once '../Modelo/Producto.php';
require_once '../Servicio/CestaCompra.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado de Productos</title>
        <link href="../estilos/tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body class="pagproductos">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>

            <!-- Dividir en varios templates -->
            <div id="cesta">      
                <h3><img src='../icono/cesta.png' alt='Cesta' width='40' height='40'>  Cesta 
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
                <form id='comprar' action='cesta_vista.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                </form>
            </div>

            <div id="productos">
                <?php if (isset($mensaje_sin_productos)): ?>
                    <h3><?= $mensaje_sin_productos ?></h3>
                <?php else: ?>
                    <?php if (isset($array_productos)):?>
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
                                    <form id='anadir' onsubmit="anadirProductos(this); return false" action='listado_productos_vista.php?familia=<?= $cod_familia ?>' method='post'>
                                        <input type="number" name='unidades_cargar' value='1' class="cantidad">
                                        <input type='submit' name='anadir' value='Añadir' id="java" />
                                        <input type='hidden' name='cod_cargar' value='<?= $producto->getCod() ?>'/>
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
                <a href="../Vista/listado_familias_vista.php">Ir a Listado Familias</a>
                <br>
                <a href="../Vista/cesta_vista.php">Ir a Cesta</a>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario' class="desconectar"/>
                </form>  
            </div>
        </div>

        <?php if (isset($mensaje_catch)): ?>
            <div id="mensaje_error">
                <p class="error"><?= $mensaje_catch ?></p>
            </div>
        <?php endif ?>
        <script src="../cargarDatos.js" ></script>
    </body>
</html>
