<?php
require_once('include/DB.php');
/* Formulario de login
 * Si se introducen las credenciales correctas, guarda el nombre de usuario en 
 * la variable de sesión y redirige a listado_familias.php
 * En caso contrario, muestra un mensaje de error.
 */
$error="";
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['login'])) {
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];

    if (empty($usuario) || empty($password)) 
        $error = "Debes introducir un nombre de usuario y una contraseña";
    else {
        // Comprobamos las credenciales con la base de datos
        if (DB::verificaCliente($usuario, $password)) {
            session_start();
            $_SESSION['usuario']=$usuario;
            header("Location: listado_familias.php");                    
        }
        else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $error = "Usuario o contraseña no válidos!";
        }
    }
} elseif (isset($_GET['redirigido'])){
    $error="Haga login para continuar";
}

// Incluimos el fichero de la vista para presentar los datos
require_once('vista/vista_login.php');