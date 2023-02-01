<?php
require_once '../Modelo/DB.php';
if (isset($_REQUEST['logout'])) {
    $mensaje_logout = 'Sesión cerrada correctamente';
}
//Compruebo si vengo redireccionado sin tener sesion
if (isset($_REQUEST['redirigido'])) {
    $mensaje_sin_sesion = 'Debe iniciar sesion previamente';
}

if (isset($_POST['enviar'])) {

        //RECOGIDA DE DATOS DEL FORMULARIO LOGIN:
        $nombre = htmlspecialchars($_POST['usuario']);
        $contra = htmlspecialchars($_POST['password']);
        
        //Hago la consulta
        if (DB::verificaCliente($nombre, $contra)){
             //En caso de que se haya loggeado correctamente
            session_start();
            //Guardo el nombre del usuario en la session
            $_SESSION['usuario'] = $nombre;
        
            //Redirecciono a la página de familias_productos
            header('Location: listado_familias_vista.php');
        }else{
             //Si es falso, muestra el mensaje de error
            $mensaje_login_fallido = "Usuario y/o contraseña no válido";
        }
}

?>
