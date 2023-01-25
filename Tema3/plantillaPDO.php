<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01
<?php

$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
try {
    $bd = new PDO ($cadena_conexion, $usuario, $clave);
    
    
} catch (PDOException $e) {
    echo 'Error con la base de datos:' .$e->getMessage();
}




?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <label>Productos</label>
                <select>
                    <option value=""> <?php ?> </option>
                </select>
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            <h2>Stock del producto en las tiendas</h2>
        </div>
        <div id="pie">
        </div>
    </body>
</html>