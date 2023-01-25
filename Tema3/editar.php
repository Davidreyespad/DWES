<?php

    try {

        if (isset ($_POST["editar"])){

            $cod= $_POST["cod"];
            $nombre= $_POST["nombre"];
            $nombre_corto= $_POST["nombre_corto"];
            $descripcion= $_POST["descripcion"];
            $PVP= $_POST["PVP"];
        }     

    } catch (PDOException $e) {
        echo 'Error con la base de datos:' .$e->getMessage();
    }


?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html" charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenido">
            
            <h2 class="titulo"> Tabla de <?= $nombre ?></h2>
            
                        
                <table>
                        <tr>
                            <th><strong>Código</strong></th>                                                        
                            <th><strong>Nombre</strong></th>                            
                            <th><strong>Nombre corto</strong></th>
                            <th><strong>Descripcion</strong></th>
                            <th><strong>PVP</strong></th>
                            <th><strong>Actualizar</strong></th>
                            <th><strong>Cancelar</strong></th>                            
                        </tr>
                                            
                        <tr>
                            <td><?=$cod ?></td>
                            <form id= "datos_enviados" action="actualizar.php" method="post">    
                                <td><input type="text" name="nombre" value="<?= $nombre ?>"/></td>
                                <td><input type="text" name="nombre_corto" value="<?=$nombre_corto ?>"/></td>
                                <td><input type="text" name="descripcion" value= " <?=$descripcion ?>"/></td>
                                <td><input type="text" name="PVP" value="<?= $PVP ?>"/></td>
                                <td><input type="submit" name= "Actualizar" value="Actualizar"/></td>
                                <td><input type="submit" name= "Cancelar" value="Cancelar"/></td> 
                            </form>
                                                   
                        </tr>
                    
                </table>
            
        </div>
        <div id="pie">
        </div>
    </body>
</html>


