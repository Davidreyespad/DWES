<?php
/**
  require_once './funciones.php';

  comprobarSesion();
 */
try {

    if (isset($_POST['Siguiente'])) {

        $palabra = $_POST['palabra1'];
        $palabraVacia = ["pepe"];

        if ($palabra = $palabraVacia) {

            session_start();

            $nombresIguales = $_SESSION['palabra1'];

            header('Location: ./sesiones_2.php');
        } else {
            $aviso = 'Hubo un fallo con la palabra';
        }
    }
} catch (Exception $ex) {
    $ex = "Fallo";
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
            <?php
            if (isset($aviso)) {
                echo "<p class=aviso>$aviso</p>";
            }
            ?>
            <?php
            if (isset($ex)) {
                echo "<p class=aviso>$ex</p>";
            }
            ?>
            <p>
                <input type="submit" value="Siguiente" name="Siguiente">
                <input type="reset" value="Borrar">
            </p>
        </form>
    </body>
</html>
