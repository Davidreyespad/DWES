<?php
require_once './DB.php';

$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {

    $bd = new PDO($cadena_conexion, $usuario, $clave);

    if (isset($_POST['Enviar'])) {

        $nombre = $_POST["usuario"];
        $contrasena = md5($_POST["password"]);

        $ejecutar = new DB();

        $ejecucion = $ejecutar->verificaCliente($nombre, $contrasena);
        if($ejecucion==false){
            $mensaje_excepcion = "Fallo en la contraseña o en el usuario";
        }
    }
} catch (PDOException $ex) {
    $mensaje_excepcion = "Algo no ha salido bien:" . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Login Tienda</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div id='login'>

            <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                <fieldset >
                    <legend>Login</legend>

                    <?php if (isset($mensaje_login_fallido)): ?>
                        <p class="error"><?= $mensaje_login_fallido ?></p>
                    <?php endif ?>
                    <?php if (isset($mensaje_logout)): ?>
                        <p class="correcto"><?= $mensaje_logout ?></p>
                    <?php endif ?>
                    <div class='campo'>
                        <label for='usuario'>Usuario:</label><br/>
                        <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
                    </div>
                    <div class='campo'>
                        <label for='password' >Contraseña:</label><br/>
                        <input type='password' name='password' id='password' maxlength="50" /><br/>
                    </div>

                    <div class='campo'>
                        <input type='submit' name='Enviar' value='Enviar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>