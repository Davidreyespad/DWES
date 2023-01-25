<?php

if (isset($_SERVER['devuelto'])){
    $aviso = "Debe pasar primero por el login";
}

$conexion = 'mysql:host=localhost;dbname=dwes';
$usuario = "root";
$clave = "notiene";

try {

    $bd = new PDO($conexion, $usuario, $clave);

    if (isset($_REQUEST['enviar'])) {

        $user = $_POST['usuario'];
        $pass = md5($_POST['clave']);

        $query = 'SELECT * FROM usuarios WHERE usuario=:usu and password=:clav';
        $prepare_login = $bd->prepare($query);
        $parametros = [":usu = $user, :clav= $pass"];
        $prepare_login->execute();
        $sesion = $prepare_login->fetchAll(PDO::FETCH_OBJ);

        if ($sesion > 1) {

            session_start();

            $nombreUsuario = $_SESSION['usuario'];

            header('Location: ./sesiones_1.php');
        } else {
            $aviso = 'Hubo un error';
        }
    }
} catch (PDOException $ex) {
    $ex = "Fallo";
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de login</title>
        <meta charset = "UTF-8">
        <link href="sesiones.css" rel="stylesheet" type="text/css">
    </head>
    <body>	
        <?php
        if (isset($aviso)) { echo "<p class=aviso>$aviso</p>";}
        ?>
        <?php
        if (isset($ex)) {
            echo "<p class=aviso>$ex</p>";
        }
        ?>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
            <label for = "usuario">Usuario</label> 
            <input id = "usuario" name = "usuario" type = "text">		
            <label for = "clave">Clave</label> 
            <input id = "clave" name = "clave" type = "password">					
            <input type = "submit" name="enviar">
        </form>
    </body>
</html>
