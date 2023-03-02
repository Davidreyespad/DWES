<?php
$conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {
    $bd = new PDO($conexion, $usuario, $clave);
    
    //Capturamos el codigo del pedido
    if(isset($_POST["enviar"])){
        $codped = $_POST["pedido"];
    }
    
    //Hacemos la consulta para sacar los pedidos en la lista desplegable
    $query = 'SELECT * FROM pedidos';
    $consulta_pedidos= $bd->query($query);
    $pedidos = $consulta_pedidos->fetchAll();
    
  if(isset($_POST["enviar"])){
    $query2 = "SELECT pedidosproductos.unidades as unidades, producto.nombre_corto as nombre_prod,"
            . "pedidosproductos.codpedprod as codpedprod "
            . "FROM producto INNER JOIN pedidosproductos ON producto.cod= pedidosproductos.codprod "
            . "WHERE pedidosproductos.codped = " . $codped . "";
      
      
      $consulta_productos = $bd->query($query2);
      //Obtenemos un objeto
      $productos = $consulta_productos->fetchAll(PDO::FETCH_OBJ);
    }
    
  if(isset($_POST["actualizar"])){
     //Almacenamos tanto el nombre como las unidades del producto en rrays
     $array_unidades = $_POST["unidades"];
      
     //El codigo del pedido-producto viene como hidden
     $array_codpredprod = $_POST["codpedprod"];   
        
     $query3 = 'UPDATE pedidosproductos SET unidades =:unidades WHERE codpedprod =:codpedprod';
     $preparada = $bd->prepare($query3);
       
     $contador = "";
       
     //Bucle para que se actualizen todas las unidades de los pedidos modificados
for($index = 0; $index < count($array_unidades); $index++){
$preparada->execute(array('unidades'=>$array_unidades[$index], 'codpedprod'=>$array_codpredprod[$index]));
$contador=$preparada->execute(array('unidades'=>$array_unidades[$index], 'codpedprod'=>$array_codpredprod[$index]));          
       }
       
       if($contador = "111"){
           echo "<h3 id='correcto'>Se ha realizado correctamente la actualización </h3>";
       }
       
    }
} catch (PDOException $ex) {
    if($contador != "111"){
           echo "<h3 id='error'>No se ha realizado correctamente la actualización </h3>";
       }
    echo "<br>";   
    $errorPDO = "¡Error!: " . $ex->getMessage();
    echo $errorPDO;
}

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Plantilla para Examen Tema 3</title>
        <link href="pedido.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Modifica un pedido</h1>
            <br>
  <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <span>Pedidos: </span>
     <select name="pedido">
       <?php foreach ($pedidos as $value) :?>
         <?php if(isset($codped) && $codped == $value["codped"]): ?>
          <option value="<?= $value["codped"] ?>" selected="true"> Pedido: <?= $value["codped"] ?></option>
         <?php else: ?>  
           <option value="<?= $value["codped"] ?>" > Pedido: <?= $value["codped"] ?></option>
         <?php endif; ?>
       <?php endforeach;?>
                </select>
                <input type="submit" value="Mostrar" name="enviar"/>
            </form>
        </div>
  <div id="contenido">
      
   <?php if(isset($productos)): //comprobamos si tenemos $productos?>
    <h2>Unidades de cada producto</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
           <?php foreach ($productos as $valor) :?>
        <p> Producto <?= $valor->nombre_prod ?>:  
            <input name="unidades[]" type="text" value="<?= $valor->unidades ?>"> </input>
            unidad/es </p>
        <input type="hidden" value="<?= $valor->codpedprod ?>" name="codpedprod[]">
        
           <?php endforeach;?>
        <input type="submit" name="actualizar" value="Actualizar">
   <?php endif; ?>
      </form>
        </div>
        <div id="pie">
            <?php if (isset($errorPDO)): ?>
                    <p class="error"><?= $errorPDO ?></p>
            <?php endif ?>
        </div>
    </body>
</html>

