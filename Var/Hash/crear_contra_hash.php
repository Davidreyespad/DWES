<?php
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario_conexion = 'david';
$clave_usuario = 'usuario';


try{
    
    $bd = new PDO($cadena_conexion, $usuario_conexion, $clave_usuario);
    
    $usuario= 'pedro';
    $clave = password_hash('usuario', PASSWORD_DEFAULT);
    
    $consulta = "INSERT INTO usuarios (usuario, password) VALUES('$usuario', '$clave')";
    $bd->query($consulta);

} catch (Exception $e) {
    
}

?>
