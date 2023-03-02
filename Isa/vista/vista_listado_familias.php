<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: vista_listado_familias.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Tema 5</title>
        <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h2>Listado de familias</h2>
            </div>
            <div id="cesta">      
                <h3><img src='img/cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
                <hr />
                <?php if ($cesta->is_vacia()): ?>
                    <p>Cesta vacía</p>
                <?php else: ?>
                     <?php foreach ($productoscesta as $p): ?>
                         <p><?= $p['producto']->get_nombre_corto()?> x <?= $p['unidades']?> unidades</p>
                     <?php endforeach; ?>
                <?php endif; ?>
             
                <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                <?php if ($cesta->is_vacia()): ?>
                    <input type='submit' name='vaciar' value='Vaciar Cesta' disabled='true' />
                <?php else: ?>
                    <input type='submit' name='vaciar' value='Vaciar Cesta' />
                <?php endif; ?>
                </form>
                         
                <form id='comprar' action='cesta.php' method='post'>
                <?php if ($cesta->is_vacia()): ?>
                    <input type='submit' name='comprar' value='Comprar' disabled='true' />
                <?php else: ?>
                    <input type='submit' name='comprar' value='Comprar' />
                <?php endif; ?>
                </form>
            </div>

            <div id="productos">
                <ul>
                <?php foreach ($familias as $familia): ?>
                   <li><a href='listado_productos.php?familia=<?= $familia->getcodigo() ?>'><?= $familia->getnombre()?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>

            <br class="divisor" />
              <div id="pie">
                <a href="logout.php">Desconectar usuario <?= $usuario; ?></a>
                <a href="pedidos.php">Ver pedidos realizados</a>
              </div>
        </div>
    </body>
</html>
