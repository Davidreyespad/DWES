<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: vista_televisor.php -->
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
      <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Pulgadas</th>
          <th>Resolución</th>
          <th>Panel</th>
          <th>Añadir</th></tr>
      <tr>
          <td><?= $televisor->get_codigo() ?></td>
          <td><?= $televisor->get_nombre_corto() ?></td>
          <td><?= $televisor->get_PVP() ?></td>
          <td><?= $televisor->get_pulgadas() ?> "</td>
          <td><?= $televisor->get_resolucion() ?></td>
          <td><?= $televisor->get_panel() ?></td>
          <td><form action='anadir.php' method='post'>
            <input type='hidden' name='cod' value='<?= $televisor->get_codigo() ?>'/>    
            <input type='number' name='unidades' min='1' max='100' value='1'/>
            <input type='submit' name='añadir' value='Añadir'/>
            </form>
          </td>
      </tr>
    </table>
  </div>
  <br class="divisor" />
  <div id="pie">
      <a href="listado_familias.php">Página principal</a>
      <a href="logout.php">Desconectar usuario <?= $usuario; ?></a>      
  </div>
</div>
</body>
</html>

