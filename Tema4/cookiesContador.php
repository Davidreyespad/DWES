<?php
    if (isset($_REQUEST['logout'])) { $mensaje_cerrar_sesion = 'Sesión cerrada correctamente';
    }

$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

    if (isset($_REQUEST["redirigido"])){ $mensaje_login_fallido = "Debe pasar por Login";
        }
try {

    if (isset($_POST["enviar"])) {
        $mensaje_login_fallido;
        $mensaje_cerrar_sesion;
        
        $user = $_POST["usuario"]; //Recojo el usuario
        
        $pass = md5($_POST["password"]); //La contraseña la encriptamos en md5

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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (!isset($_COOKIE['contador'])){
            setcookie('contador', '1', time() + 3600 * 24);
            echo "Bienvenido por primera vez.";
        } else{
            $contador = (int) $_COOKIE['contador'];
            $contador++;
            setcookie('contador', $contador, time() + 3600 * 24);
            echo "Bienvenido por $contador vez.";
        }   
        ?>
    </body>
</html>
