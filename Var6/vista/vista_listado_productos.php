<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: vista_listado_productos.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejemplo Tema 5: Listado de Productos</title>
  <link href="CSS/tienda.css" rel="stylesheet" type="text/css" />
</head>

<body class="pagproductos">

<div id="contenedor">
  <div id="encabezado">
    <h2>Listado de productos</h2>
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
            <input type='hidden' name='familia' value='<?= $familia ?>' /> 
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
    <table>
        <?php if ($productos): ?>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Añadir</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $producto->get_codigo() ?></td>
                <td>
                    <?php if($producto->get_familia() != "TV"): ?>
                        <?= $producto->get_nombre_corto() ?>
                    <?php else: ?>
                        <a href="televisor.php?cod=<?= $producto->get_codigo() ?>"><?= $producto->get_nombre_corto() ?></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?= $producto->get_PVP() ?> euros
                </td>
                <td>
                    <form action='anadir.php' method='post'>
                        <input type='hidden' name='cod' value='<?= $producto->get_codigo() ?>'/>
                        <input type='number' name='unidades' min='1' max='100' value='1'/>
                        <input type='submit' name='añadir' value='Añadir'/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
  </div>
  <br class="divisor" />
  <div id="pie">
      <a href="listado_familias.php">Página principal</a>
      <a href="logout.php">Desconectar usuario <?= $usuario; ?></a>
      <a href="pedidos.php">Ver pedidos realizados</a>
  </div>
</div>
</body>
</html>

