<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: login.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Tema 5: Login Tienda Web</title>
  <link href="CSS/tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id='login'>
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
    <fieldset >
        <legend>Login</legend>
        <div><span class='error'><?= $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input value="<?php if(isset($usuario))echo $usuario;?>"
                type='text' name='usuario' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' id='password' maxlength="50" /><br/>
        </div>

        <div class='campo' style='text-align: center'>
            <input type='submit' name='login' class='boton' value='Enviar' />
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>
