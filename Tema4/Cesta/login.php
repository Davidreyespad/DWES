<?php
//Compruebo si vengo de cerrar Sesión
if (isset($_REQUEST['logout'])) {
    $mensaje_logout = 'Sesión cerrada correctamente';
}

//Variables para la conexión a la bd
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {


    if (isset($_POST["enviar"])) {

        //RECOGIDA DE DATOS DEL FORMULARIO LOGIN:
        //Recojo el usuario
        $user = $_POST["usuario"];
        //La contraseña la encriptamos en md5 (Para ello, la contraseña en la base de datos
        //tiene que estar también encriptada)
        $pass = md5($_POST["password"]);

        //Hago la conexión a la bd
        $bd = new PDO($cadena_conexion, $usuario, $clave);

        $query = "SELECT * FROM usuarios WHERE usuario= :nombre AND password= :clave";
        $preparar_login = $bd->prepare($query);
        $parametros = [":nombre" => $user, ":clave" => $pass];
        $preparar_login->execute($parametros);
        $num_fila = $preparar_login->rowCount();

        //Si me devuelve 0, es que no ha encontrado coincidencias
        if ($num_fila > 0) {
            //En caso de que se haya loggeado correctamente
            session_start();
            //Guardo el nombre del usuario en la session[FLAG]
            $_SESSION['usuario'] = $user;

            //MEJORA PARA CUANDO VA AL LOGIN CON UNA SESIÓN ABIERTA:
            //if(isset($_SESSION['usuario'])){
            //    header('Location:continuar_cerrar_sesion.php?redireccionado=true');
            //}else{
            //    $_SESSION['usuario'] = $user;
            //    header('Location: sesiones.php');
            //}
            
            //Redirecciono a la página de familias_productos
            header('Location: listado_familias.php');
        } else {
            //Si el rowCount es cero, muestra el mensaje de error
            $mensaje_login_fallido = "Usuario y/o contraseña no válido";
        }
    }
} catch (Exception $ex) {
    $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
}

// <div><span class='error'><?= $mensaje (interrogación)></span>
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
                        <input type='submit' name='enviar' value='Enviar' />
                    </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>