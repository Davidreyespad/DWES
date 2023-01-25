<?php
require_once './funciones.php';
comprobarSesion();

if (isset($_REQUEST["raros2"])) {
    $mensaje_login_fallido = 'Aquí hay cositas raras';
}
if (isset($_REQUEST["vacio2"])) {
    $mensaje_login_fallido = "Esto está vacío";
}
if (isset($_REQUEST["iguales"])) {
    header('Location: ./sesiones_5.php');
}
try {
    if (isset($_POST['Siguiente'])) {
        $mensaje_login_fallido;

        $palabra2 = $_POST['palabra2'];

        $_SESSION['palabra2'] = $palabra2;
                
        header('Location: ./sesiones_4.php');
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
            Formulario de confirmación (Formulario 2).
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="sesiones.css" title="Color">
    </head>

    <body>
        <h1>Formulario de confirmación (Formulario 2)</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <p>Repita la palabra que acaba de escribir:</p>
            <p><label>Escriba de nuevo: <input type="text" name="palabra2" size="30" maxlength="30"></label></p>
            <?php if (isset($mensaje_login_fallido)): ?>
                <p style="color:red"><?= $mensaje_login_fallido ?></p>
            <?php endif ?>
            <?php if (isset($mensaje_excepcion)): ?>
                <p style="color:red"><?= $mensaje_excepcion ?></p>
            <?php endif ?>
            <p>
                <input type="submit" value="Siguiente" name="Siguiente">
                <input type="reset" value="Borrar">
            </p>
        </form>
    </body>
</html>
