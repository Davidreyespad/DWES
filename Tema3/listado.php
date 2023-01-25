<?php
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
$mensaje = '';

try {
    $bd = new PDO ($cadena_conexion, $usuario, $clave);

if (isset ($_POST["enviar"])){
    $codigoEnviado = $_POST["cod_prod"];
        
    $consultaFamilia = "SELECT * FROM producto WHERE familia='". $codigoEnviado."'";
    
    $resultadoConsulta = $bd->query($consultaFamilia);
    
    if ($resultadoConsulta){
        $producto=$resultadoConsulta->fetchAll(PDO::FETCH_OBJ);
    }
    
}     
} catch (PDOException $e) {
    echo 'Error con la base de datos:' .$e->getMessage();
}
$query= "SELECT * FROM familia";
    
    $resultadoQuery = $bd->query($query);
    
    if($resultadoQuery){
        $familia= $resultadoQuery->fetchAll(PDO::FETCH_OBJ);
        
        foreach ($familia as $value){
            if ($value->cod==$codigoEnviado) {
                $nombre_familia_selec = $value->nombre;
            }
        }
        
    }else{
       $mensaje="Consulta con errores";
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
            <h1>EJERCICIO 4 </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Familia</label>
                <select name="cod_prod">
                    <?php foreach ($familia as $value):?>
                       <?php if($cod_enviado==$value->cod) :?>   
                            <option value="<?= $value->cod ?>" selected> <?=$value->nombre?> </option>
                        <?php else:?>
                            <option value="<?= $value->cod?>"> <?=$value->nombre?> </option>
                        <?php endif?>
                    <?php endforeach?>
                </select>
                <input type="submit" name= "enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            
            <h2 class="titulo"> Tabla de la familia <?= $nombre_familia_selec ?> </h2>
            
                <?php if (isset ($codigoEnviado)) :?>
            
                    <?php foreach ($producto as $value) :?>

                        <table>
                                <tr>
                                    <th><strong>Nombre corto</strong></th>
                                    <th><strong>PVP</strong></th>
                                    <th><strong>Modificar</strong></th>
                                </tr>

                                <tr>
                                    <td><?=$value->nombre_corto?></td>
                                    <td><?=$value->PVP?></td>
                                    <td>
                                        <form id= "editar_datos" action="editar.php" method="post">
                                            
                                            <input type="hidden" name="cod" value="<?=$value->cod?>"/>
                                            <input type="hidden" name="nombre" value="<?=$value->nombre?>"/>
                                            <input type="hidden" name="nombre_corto" value="<?=$value->nombre_corto?>"/>
                                            <input type="hidden" name="descripcion" value="<?=$value->descripcion?>"/>
                                            <input type="hidden" name="PVP" value="<?=$value->PVP?>"/>
                                                                               
                                            <input type="submit" name= "editar" value="Editar"/>
                                        </form>
                                    </td>
                                </tr>

                        </table>
            
                    <?php endforeach;?>

                <?php endif;?>  
        </div>
        <div id="pie">
        </div>
    </body>
</html>


