<?php
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';

    try {
        $bd = new PDO ($cadena_conexion, $usuario, $clave);

        if (isset ($_POST["Actualizar"])){
            
            $cod= $_POST["cod"];
            $nombre= $_POST["nombre"];
            $nombre_corto= $_POST["nombre_corto"];
            $descripcion= $_POST["descripcion"];
            $PVP= $_POST["PVP"];
            
            $query= "UPDATE producto SET nombre= :nombre WHERE cod= '". $cod. "'";
            
            $consultaActualizacion = $bd->query($query);
            
            if ($consultaActualizacion){
                header("Location:listado.php?resultado=1");
            }
        }     
        
            print_r($consultaActualizacion);


        if (isset ($_POST["Cancelar"])){


        } 
    } catch (PDOException $e) {
        echo 'Error con la base de datos:' .$e->getMessage();
    }

    
?>

