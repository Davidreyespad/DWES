<?php

require_once '../Modelo/Producto.php';

//Script para comprobar que se ha iniciado sesión
function comprobarSesion() {
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header('Location: ../Vista/login_vista.php?redirigido=true');
    }
}

function desconectame() {
        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();

        //Lo redirecciono a la página de Login para que inicie sesión
        header('Location: ../Vista/login_vista.php?logout=true');   
}


?>


