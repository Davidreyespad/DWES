<?php
if (isset($_REQUEST["redirigido"])) {
    $mensaje_login_fallido = "Haga login para continuar";
}

if (isset($_REQUEST['logout'])) {
    $mensaje_cerrar_sesion = 'Sesión cerrada correctamente';
}

try {

    if (isset($_POST['enviar'])) {

        $mensaje_login_fallido;

        $user = $_POST['usuario'];
        $user2 = $_POST['clave'];

        if ($user == "" && $user2 == "") {
            $mensaje_login_fallido = 'Debe introducir usuario y contraseña';
        } elseif ($user === $user2) {

            session_start();

            $_SESSION['usuario'] = $user;

            header('Location: ./sesiones_1.php');
        } else {
            $mensaje_login_fallido = 'Usuario o contraseñas incorrectas';
        }
    }
} catch (Exception $ex) {
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

        <?php if (isset($mensaje_cerrar_sesion)): ?>
            <p style="color:red"><?= $mensaje_cerrar_sesion ?></p>
        <?php endif ?>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
            <label for = "usuario">Usuario</label> 
            <input id = "usuario" name = "usuario" type = "text">		
            <label for = "clave">Clave</label> 
            <input id = "clave" name = "clave" type = "password">					
            <input type = "submit" name="enviar">
        </form>
    </body>
</html>
