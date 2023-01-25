<?php
$idioma = "esp";

if (isset($_POST["Enviar"])) {

    $idioma = $_POST["idoma"];
    setcookie('idioma', $idioma, time() + 3600 * 24);
} else {
    if (isset($_COOKIE["idioma"])) {
        $idioma = $_COOKIE["idioma"];
    }
}

//if (!isset($_COOKIE['idioma'])) {
//    setcookie('idioma', '1', time() + 3600 * 24);
//    echo "Bienvenido por primera vez.";
//} else {
//    $contador = (int) $_COOKIE['contador'];
//    $contador++;
//    setcookie('idioma', $contador, time() + 3600 * 24);
//    echo "Bienvenido por $contador vez.";
//}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>David Reyes</title>
    </head>
    <body>
        <h1>Seleccione en que idioma quiere que se muestre la web</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?> method="post">
        <select name="idoma">
            <option value="espanol">Español</option>
            <option value="ingles">Inglés</option>
            <input type="submit" name="Enviar" value="Enviar"/>
        </select>
        </form>    

        <?php if($idioma == "ing") :?>
            <h1>Tittle</h1>
            <?php elseif ($idioma == "esp") :?>
                <h1>Titulo</h1>
            <?php endif ?>    
             
    </body>
</html>
