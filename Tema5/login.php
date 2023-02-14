<?php
require_once './DB.php';


if(isset($_REQUEST['logout'])){
    $mensaje_logout = 'Sesion cerrada';
}

if(isset($_REQUEST['redirigido'])){
    $mensaje_sin_sesion = 'Tiene que iniciar sesion antes';
}

if(isset($_POST['enviar'])){
    $nombre = htmlspecialchars($_POST['usuario']);
    $contra = md5($_POST['password']);
    
    if(DB::verificaCliente($nombre, $contra)){
        
        session_start();
        
        $_SESSION['usuario'] = $nombre;
        
        header('Location: listado_familia.php');
        
    }else{
        $mensaje_login_fallido = "usuario y/o contraseña no valido";
    }
    
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login_Vista</title>
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
                        <?php if (isset($mensaje_sin_sesion)): ?>
                        <p class="error"><?= $mensaje_sin_sesion ?></p>
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