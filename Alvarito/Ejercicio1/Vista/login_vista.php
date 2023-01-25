<?php
require_once '../Controlador/login.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login_Vista</title>
        <link href="../estilos/tienda.css" rel="stylesheet" type="text/css">
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
