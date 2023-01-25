<?php
$numero = rand(1, 10);
$pares = 0;
$impares = 0;
print "\n";
print "<p>\n";
for ($i = 0; $i < $numero; $i++) {
    $dado = rand(1, 6);
    print "<img src=\"img/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">\n";
    if ($dado % 2) {
        $impares += 1;
    } else {
        $pares += 1;
    }
}
print "\n";
print "<p>\n";
print "<p>Han salido ";
if ($pares == 1) {
    print"1 número par y ";
} else {
    print"$pares números pares y ";
}
if ($impares == 1) {
    print"1 número impar. </p>\n";
} else {
    print"$impares números impares. </p>\n";
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Contar pares e impares
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <h1>Contar pares e impares</h1>
        


        <p>Actualice la página para mostrar una nueva tirada.</p>



    </body>
</html>
