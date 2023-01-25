<?php
    $color = $_POST['color'];
?>


<!DOCTYPE html>
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
    <title>Selección de colores (comprobación). Cookies.</title>
    <link href=\"examenUT4.css\" rel=\"stylesheet\" type=\"text/css\" title=\"Color\" />

    <style type="text/css">body, a {
            color: black;
        }</style>
        <?php ?>

</head>
<body>
    <h1 <?php echo "style='color:$color'"; ?>>Selección de colores (comprobación)</h1>

    <p <?php echo "style='color:$color'"; ?>>Se ha elegido el color <?= $color ?></p>   

    <p><a href="cookies_1.php" <?php echo "style='color:$color'"; ?>>Volver a la selección de color</a></p>

</body>
</html>
