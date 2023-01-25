<?php
if (isset($_REQUEST['logout'])) {
    $mensaje_cerrar_sesion = 'Sesión cerrada correctamente';
}

$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

if (isset($_REQUEST["redirigido"])){
        $mensaje_login_fallido = "Debe pasar por Login antes de continuar";
    }

try {

    if (isset($_POST["enviar"])) {
        $mensaje_login_fallido;
        $mensaje_cerrar_sesion;

        //Recojo el usuario
        $user = $_POST["usuario"];
        //La contraseña la encriptamos en md5 (Para ello, la contraseña en la base de datos
        //tiene que estar también encriptada)
        $pass = md5($_POST["password"]);

        $bd = new PDO($cadena_conexion, $usuario, $clave);

        $query = "SELECT * FROM usuarios WHERE usuario= :nombre AND password= :clave";
        $preparar_login = $bd->prepare($query);
        $parametros = [":nombre" => $user, ":clave" => $pass];
        $preparar_login->execute($parametros);
        $num_fila = $preparar_login->rowCount();

        if ($num_fila > 0) {
            //En caso de que se hata loggeado correctamente
            session_start();
            //Guardo el nombre del usuario en la session
            $_SESSION['usuario'] = $user;

            //Redirecciono a la página de bienvenida Ejercicio Cookies
            //header('Location: bienvenida.php');
            //Redirecciono a la página de sesiones Ejercicio Sesiones
            header('Location: ./listado_familias.php');
        } else {
            $mensaje_login_fallido = "Usuario y/o contraseña no válido";
        }
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
    </head>
    <body>
        <div id="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <fieldset>
                    <legend>Login</legend>
                    <div></div>
                    <div class="campo">
                        <label for="usuario">Introduzca su usuario:</label><br>
                        <input type="text" name="usuario" id="usuario">
                        <br/>
                    </div>   
                    <div class="campo">
                        <label for="password">Introduzca su contraseña:</label><br>
                        <input type="password" name="password" id="password">
                        </br>
                    </div>   
                    <div class="campo">
                        <input type="submit" name="enviar" value="Enviar">
                    </div>
                </fieldset>
            </form>


            <?php if (isset($mensaje_excepcion)): ?>
                <p style="color:red"><?= $mensaje_excepcion ?></p>
            <?php endif ?>


            <?php if (isset($mensaje_login_fallido)): ?>
                <p style="color:red"><?= $mensaje_login_fallido ?></p>
            <?php endif ?>
                
                
            <?php if (isset($mensaje_cerrar_sesion)): ?>
                <p style="color:red"><?= $mensaje_cerrar_sesion ?></p>
            <?php endif ?>    
                
        </div>    
    </body>
</html>
