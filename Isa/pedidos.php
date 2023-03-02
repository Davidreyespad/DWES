<?php
    require_once('include/sesiones.php');
    require_once('include/DB.php');
    require_once('include/Pedido.php');

    // Recuperamos la información de la sesión
    // Y comprobamos que el usuario se haya autentificado
    comprobar_sesion();
    
    // Obtenemos el usuario de la sesión
    $usuario = $_SESSION['usuario'];

    // Obtenemos los pedidos a mostrar
    $pedidos=DB::obtienePedidos($usuario); 
    ?>

<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: pedidos.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejemplo Tema 5: Cesta de la Compra</title>
  <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
</head>

<body class="pagcesta">

<div id="contenedor">
  <div id="encabezado">
    <h2>Pedidos realizados por el usuario <?= $usuario; ?></h2>
  </div>
  <div id="productos">
      
<?php foreach ($pedidos as $p): ?>
      <h3>Pedido: <?= $p->get_codped(); ?> Fecha: <?= $p->get_fecha(); ?></h3>    
      <?php $pedidosproductos = DB::obtienePedidosProductos($p->get_codped());?>
      <table>
          <tr><th>Producto</th><th>Unidades</th></tr>
        <?php foreach ($pedidosproductos as $pedprod): ?>
             <tr><td><?= $pedprod->get_producto(); ?></td>
             <td><?= $pedprod->get_unidades(); ?></td></tr>
        <?php endforeach; ?>
        <tr><td><b>Coste:</td><td><?= $p->get_coste(); ?></td></tr>
      </table>

<?php endforeach; ?>
      
    <hr />
  </div>
  <br class="divisor" />
  <div id="pie">
      <a href="listado_familias.php">Página principal</a>
      <a href="logout.php">Desconectar usuario <?= $usuario; ?></a>    
  </div>
</div>
</body>
</html>