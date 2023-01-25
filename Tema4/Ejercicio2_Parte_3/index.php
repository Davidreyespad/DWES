<?php
if (isset($_REQUEST['logout'])) {
    $mensaje_cerrar_sesion = 'Sesión cerrada correctamente';
}
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

//Capturo el contenido del header en caso de que venga redirigido
    if (isset($_REQUEST["redirigido"])){
        $mensaje_login_fallido = "Debe pasar por Login antes de continuar";
    }
    
try {
    
    if (isset($_POST["enviar"])) {

        //Creo una variable para mostrar un mensaje en caso de no acertar user y contra
        $mensaje_login_fallido;
        $mensaje_cerrar_sesion;

        //Recojo el usuario
        $user = $_POST["usuario"];
        //La contraseña la encriptamos en md5 (Para ello, la contraseña en la base de datos
        //tiene que estar también encriptada)
        $pass = md5($_POST["password"]);

        $bd = new PDO($cadena_conexion, $usuario, $clave);

        $query = "SELECT * FROM usuarios WHERE Nombre= :nombre AND clave= :clave";
        $preparar_login = $bd->prepare($query);
        $parametros = [":nombre" => $user, ":clave" => $pass];
        $preparar_login->execute($parametros);
        $num_fila = $preparar_login->rowCount();
        
        //Si me devuelve 0, es que no ha localhost/DWES/Tema4/Ejercicio2/sesiones.phpencontrado coincidencias
        
        if ($num_fila > 0) {
            //En caso de que se hata loggeado correctamente
            session_start();
            //Guardo el nombre del usuario en la session
            $_SESSION['usuario'] = $user;

            //Redirecciono a la página de bienvenida Ejercicio Cookies
            //header('Location: bienvenida.php');
            //Redirecciono a la página de sesiones Ejercicio Sesiones
            header('Location: ./sesiones.php');
        } else {
            $mensaje_login_fallido = "Usuario y/o contraseña no válido";
        }
    }
} catch (Exception $ex) {
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label for="usuario">Introduzca su usuario:</label>
            <input type="text" name="usuario">
            <label for="password">Introduzca su contraseña:</label>
            <input type="password" name="password">

            <input type="submit" name="enviar" value="Enviar">
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
                

    </body>
</html>