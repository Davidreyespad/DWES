<?php
require_once './funciones.php';
comprobarSesion();

if (isset($_REQUEST["raros"])) {
    $mensaje_login_fallido = '?¿_:;=)(&·%$';
}
if (isset($_REQUEST["vacio"])) {
    $mensaje_login_fallido = "Menos gente que en un descampao";
}
if (isset($_REQUEST["desiguales"])) {
    $mensaje_login_fallido = "No es la misma palabra hermano";
}
if (isset($_REQUEST["valida"])) {
    header('Location: ./sesiones_3.php');
}
try {
    if (isset($_POST['Siguiente'])) {
        $mensaje_login_fallido;
        $palabra = $_POST['palabra1'];
        $_SESSION['palabra1'] = $palabra;
        header('Location: ./sesiones_2.php');
    }
} catch (Exception $ex) {
    $mensaje_excepcion = "Algo no ha salido bien:" . $ex->getMessage();
    echo $mensaje_excepcion;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Formulario de confirmación (Formulario 1).
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="sesiones.css" title="Color">
    </head>

    <body>
        <h1>Formulario de confirmación (Formulario 1)</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <p>Escriba una palabra (con letras mayúsculas, letras minúsculas y números):</p>

            <p><label>Palabra: <input type="text" name="palabra1" size="20" maxlength="20"></label> </p>
            <?php if (isset($mensaje_login_fallido)): ?>
                <p style="color:red"><?= $mensaje_login_fallido ?></p>
            <?php endif ?>
            <p>
                <input type="submit" value="Siguiente" name="Siguiente">
                <input type="reset" value="Borrar">
            </p>
        </form>
    </body>
</html>

