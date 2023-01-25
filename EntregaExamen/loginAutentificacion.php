<?php
$usuario = 'david';
$clave = 'usuario';
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';

try {

    $bd = new PDO($cadena_conexion, $usuario, $clave);

    if (isset($_POST['enviar'])) {
        $mensaje_login_fallido;

        $user = $_POST["usuario"];
        //La contraseña la encriptamos en md5 (Para ello, la contraseña en la base de datos
        //tiene que estar también encriptada)
        $pass = md5($_POST["password"]);

        $bd = new PDO($cadena_conexion, $usuario, $clave);

        $query = 'SELECT * FROM usuarios WHERE usuario=:usu AND password=:clav';
        $prepare_login = $bd->prepare($query);
        $parametros = [":usu" => $user, ":clav" => $pass];
        $prepare_login->execute($parametros);
        $num_fila = $prepare_login->rowCount();

        if ($num_fila > 0) {

            print "true";
        } else {
            $mensaje_login_fallido = 'False';
        }
    }
} catch (PDOException $ex) {
    $mensaje_excepcion = "Algo no ha salido bien:" . $ex->getMessage();
    echo $mensaje_excepcion;
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
<?php if (isset($mensaje_excepcion)): ?>
            <p style="color:red"><?= $mensaje_excepcion ?></p>
        <?php endif ?>


        <?php if (isset($mensaje_login_fallido)): ?>
            <p style="color:red"><?= $mensaje_login_fallido ?></p>
        <?php endif ?>

        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
            <label for = "usuario">Usuario</label> 
            <input id = "usuario" name = "usuario" type = "text">		
            <label for = "clave">Clave</label> 
            <input id = "password" name = "password" type = "password">					
            <input type = "submit" name="enviar">
        </form>
    </body>
</html>
