<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01

<?php

$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';

//Comprobacion de la conexion a la base de datos.
try{
    $bd = new PDO ($cadena_conexion, $usuario, $clave);
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
if (isset($_POST['cod_prod'])) {
    $cod_prod = $_POST['cod_prod'];
}

if (isset($_POST["modificar"])){
    //recogemos valores 
    $unidadesModificadas = $_POST["unidades"];
    $tiendasModificadas = $_POST["tiendas"];

    $consultaPreparada = $bd ->stmt_init();
    $query = "UPDATE stock SET unidades =? WHERE producto = '";
    
    $consultaPreparada->prepare($query);
    for($i = 0; $i < count($tiendasModificadas); $i++){
        $consultaPreparada->bind_param('ii', $unidadesModificadas[$i], $tiendasModificadas[$i] );
        $consultaPreparada->execute();
    }
}

$query= "SELECT cod, nombre FROM producto";

$resultado=$bd->query($query);

//Se comprueba si se ha pulsado enviar
if(isset($_POST["enviar"])){
    $cod_enviado = $_POST["cod_prod"];
    
    $stock="SELECT tienda.nombre, stock.unidades FROM stock INNER JOIN tienda "
            . "ON stock.tienda=tienda.cod WHERE stock.producto='". $cod_enviado."'";
}

if($resultado){
    $productos = $resultado->fetchAll();

    foreach ($productos as $value) {
        if ($value["cod"]==$cod_enviado) {
       $nombreProductoSelec = $value["nombre"];
        }
    }
}else{
    $mensaje="Consulta erronea";
}

//SELECT tienda.nombre, stock.unidades FROM stock INNER JOIN tienda ON stock.tienda=tienda.cod WHERE stock.productos='". $cod_prod."'";

?>


?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!-- <pre> <?php //print_r($productos)?></pre> Con la etiqueta <pre> te formatea la salida del array-->
        <div id="encabezado">
            <h1>Producto: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="productos"></label>
                <select name="cod_prod">
                    <?php foreach ($productos as $value):?>
                       <?php if($cod_enviado==$value["cod"]) :?>    <!--para ver si he enviado el formulario, mostrar el producto que he enviado-->
                            <option value="<?= $value["cod"] ?>" selected> <?=$value["nombre"]?> </option>
                        <?php else:?>
                            <option value="<?= $value["cod"] ?>"> <?=$value["nombre"]?> </option>
                        <?php endif?>
                    <?php endforeach?>
                </select>
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            
            <h2>Stock de <u><?=$nombreProductoSelec?></u> en las tiendas</h2>

            <?php if (isset($cod_enviado)): //Si tengo código enviado?> 
            
                <?php if (isset($cod_prod) && count($stock) !==0) :?>

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <?php foreach ($stock as $value):?>

                            <p> Tienda <?=$value["nombre"]?>: 
                                <input type="text" name="unidades[]" value="<?=$value["unidades"]?>"/> 
                                <input type="hidden" name="tiendas[]" value="<?=$value["cod_tienda"]?>"/>
                            </p>    
                            
                            <?php endforeach;?>
                            <input type="hidden" name="producto_modificado" value=" <?=$cod_enviado ?>"/>
                            <input type="submit" name= "modificar" value="Modificar"/>

                        </form>
                   <?php else:?>
                    <p> NO hay stock de este producto</p>
                <?php endif;?>    
            <?php endif;?>
        </div>
        <div id="pie">
        </div>
    </body>
</html>