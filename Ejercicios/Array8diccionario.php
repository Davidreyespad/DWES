<!DOCTYPE html>

<?php
$idiomas = ["Español", "Inglés", "Francés", "Italiano"];

$palabras = [
    ["perro", "dog", "chien", "cane"],
    ["gato", "cat", "chat", "gatto"],
    ["enero", "january", "janvier", "gennaio"],
    ["feliz", "happy", "heureux", "felice"],
    ["viernes", "friday", "vendredi", "venerdì"],
    ["instituto", "high school", "lycée", "istituto"],
    ["vacaciones", "holidays", "vacances", "vazanze"],
    ["noniná", "", "", ""]
];

$mensaje = " ";

//Seleccion de coordenadas
$columna = rand(1, count($idiomas) - 1);
$fila = rand(0, count($palabras) - 1);
$palabraEspaniol = $palabras[$fila][0];
$palabraExtranjera = $palabras[$fila][$columna];

$mensaje .= "Columna: " . $columna . ". Fila: " . $fila . "<br>";
$mensaje .= "Idioma al que queremos traducir: <b>" . $idiomas [$columna] . "</b><br>";


if ($palabraExtranjera == "") {
    $mensaje .= "La palabra: <b>" . $palabraEspaniol . "</b> no tiene traduccion en este idioma";
} else {
    $mensaje .= "La palabra: <b>" . $palabraEspaniol . "</b>";
    $mensaje .= " en " . $idiomas[$columna] . " es: <b>" . $palabraExtranjera . "</b>";
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Diccionario multilingüe.
        </title>
    </head>

    <body>
        <h1>Diccionario multilingüe</h1>

        
        <?=$mensaje?>

 
    </body>
</html>
