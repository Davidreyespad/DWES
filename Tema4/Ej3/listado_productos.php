<?php
require_once './funciones.php';
//llamar a la funcion para comprobar si la sesion esta abierta
comprobarSesion();
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {

    $bd = new PDO($cadena_conexion, $usuario, $clave);

    if (isset($_REQUEST["familia"])) {
        $familia = $_REQUEST["familia"];
    }

    $listadoFamilias = "SELECT * FROM producto WHERE familia=:familia";
    $consultaPreparada = $bd->prepare($listadoFamilias);
    $parametro = [":familia" => $familia];
    $consultaPreparada->execute($parametro);
    $arrayFamilia = $consultaPreparada->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $ex) {
    $mensaje_excepcion = "Algo no ha salido bien:" . $ex->getMessage();
    echo $mensaje_excepcion;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="listado_productos.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <h2 class="titulo"></h2>

     <table>
         <tr>
             <th colspan="4"><strong>Listado de Productos</strong></th>
         </tr>
       <?php foreach ($arrayFamilia as $value) : ?>
          <tr>
            <td>
              <form id='anadir' action='listado_productos.php?familia=<?= $familia ?>' method='post'>
                  <input type='submit' name='anadir' value='Añadir'/>
                  <input type='hidden' name='cod' value='<?= $value->cod ?>'/>
                  <input type='hidden' name='nombre_corto' value='<?= $value->nombre_corto ?>'/>
                  <input type='hidden' name='PVP' value='<?= $value->PVP ?>'/>
                  <input type='hidden' name='familia' value='<?= $value->familia ?>'/>
               </form>
            </td>
            <td><?= $value->nombre_corto ?></td>
            <td><?= $value->PVP ?>€</td>
           </tr>
       <?php endforeach; ?>    
     </table>        
     <form id="form_seleccion" action="log_out.php" method="post">
         <input name="cerrarSesion" type="submit" value="Cerrar Sesion">
     </form>

    </body>
</html>
