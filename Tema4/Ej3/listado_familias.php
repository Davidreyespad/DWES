<?php
require_once './funciones.php';
//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {

    $bd = new PDO($cadena_conexion, $usuario, $clave);

    $listadoFamilias = "SELECT nombre,cod FROM familia";

    $consultaFamilia = $bd->query($listadoFamilias);

    if ($consultaFamilia) {
        $familiaConsulta = $consultaFamilia->fetchAll(PDO::FETCH_OBJ);
    }
} catch (PDOException $ex) {
    $mensaje_excepcion = "Algo no ha salido bien:" . $ex->getMessage();
    echo $mensaje_excepcion;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="dwes2.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenido">

       <h2 class="titulo"></h2>

       <table>
           <tr>
               <th><strong>Nombre corto</strong></th>
               <th><strong>Familia</strong></th>
           </tr>
           <?php foreach ($familiaConsulta as $value) : ?>
               <tr>
                 <td><a href="listado_productos.php?familia=<?= $value->cod ?>"><?= $value->nombre ?></td>
                 <td><?= $value->cod ?></td>
               </tr>
           <?php endforeach; ?>    
       </table>             
     </div>
  </body>
</html>
