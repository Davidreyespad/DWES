<?php
if (isset($_POST['color'])) {

    $color = $_POST['color'];
    setcookie("color", $color, time() + 8000000);
} else {
    if (isset($_COOKIE['color'])) {
        $color = $_COOKIE['color'];
    } else {
        $color = 'ninguno';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Selección de colores (selección). Cookies.</title>
        <link href="examenUT4.css" rel="stylesheet" type="text/css" title="Color">
    </head>
    <body <?php echo "style='background-color:$color'"; ?>>
        <h1>Selección de colores</h1>

        <p>Se ha elegido el color <?= $color ?></p>   

        <form action="cookies_2.php" method="POST">
            <label for="color">Cambio de color</label>
            <select name="color">
                <option value="red">Rojo</option>
                <option value="blue">Azul</option>
                <option value="green">Verde</option>
                <option value="ninguno">Ninguno</option>
            </select>
            <input type="submit" value="Cambio de color" />
        </form>

        <p><a href="cookies_2.php">Ir a otra página para comprobar la cookie</a></p>
    </body>
</html>
