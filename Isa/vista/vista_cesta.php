<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: vista_cesta.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Cesta de la Compra</title>
  <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
 
</head>

<body class="pagcesta">

<div id="contenedor">
  <div id="encabezado">
    <h2>Cesta de la compra</h2>
  </div>
  <div id="productos">
      <table id="tabla_cesta">      
    <?php if($productoscesta): ?>
        <tr><th>Código</th><th>Descripción</th><th>Precio x unidades</th><th>Eliminar</th></tr>
    <?php endif; ?>
        
    <?php foreach ($productoscesta as $ArrayProductoUnidades): ?>
        <tr><td id="codigoDelProducto"><?= $ArrayProductoUnidades['producto']->get_codigo() ?></td>
            <td><?= $ArrayProductoUnidades['producto']->get_nombre_corto() ?></td>
    <?php
        $precioUnidad=$ArrayProductoUnidades['producto']->get_PVP();
        $unidades=$ArrayProductoUnidades['unidades'];
        $precioUnidades=$precioUnidad*$unidades;
    ?>
        <td><?= $precioUnidad ?> € x <?= $unidades ?> = <?= $precioUnidades ?></td>
        
        <td><form method='POST' onSubmit="eliminarProductos (this); return false;">
            <input type='hidden' name='cod' value='<?= $ArrayProductoUnidades['producto']->get_codigo() ?>'/>
            <input type='number' name='unidades' min='1' max='100' value='1'/>
            <input type='submit' name='eliminar' value='Eliminar'/>
            </form></td></tr>
    <?php endforeach; ?>
      </table>
      <p><span id="parrafo_eliminar" class='precio'>Precio total: <?= $coste ?> €</span></p>
  </div>
  <div id="pagar">
    <hr />
    <form action='pagar.php' method='post'>
        <p><span class='pagar'>
            <input type='submit' name='pagar' value='Pagar'/>
        </span></p>
    </form>  
  </div>
   
  <br class="divisor" />
  <div id="pie">
      <a href="listado_familias.php">Página principal</a>
      <a href="logout.php">Desconectar usuario <?php echo $usuario; ?></a> 
      <a href="../pedidos.php">Ver pedidos realizados</a>
  </div>
</div>
    <script src="js/cargarDatos.js" "></script>
</body>
</html>

