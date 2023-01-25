<!DOCTYPE html>
<?php
$arrayBits = [];
$arrayBitsInverso = [];
define('NUMBITS', 10);

//generamos el array de bits
for ($i = 0; $i < NUMBITS; $i++) {
    $arrayBits[] = rand(0, 1);
}
//cambiamos los 1 por los 0 y al reves  
for ($i = 0; $i < 10; $i++) {
    if ($arrayBits[$i] == 1) {
        $arrayBitsInverso[$i] = 0;
    } else {
        $arrayBitsInverso[$i] = 1;
    }
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Cambio de bits.
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ejercicios.css" title="Color">
    </head>

    <body>
        <h1>Cambio de bits</h1>


    <?php for ($i = 0; $i < NUMBITS; $i++): ?>
        <td><?= $arrayBits[$i] ?></td>
    <?php endfor; ?>

    <br>
    <?php for ($i = 0; $i < NUMBITS; $i++): ?>
        <td><?= $arrayBitsInverso[$i] ?></td>
    <?php endfor; ?>



</body>
</html>




