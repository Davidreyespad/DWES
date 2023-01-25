<?php
$estilo = "rojo";
$text = "";
$ciclos = [
    "DAW" => ["BBDD" => "Bases de datos", "DAW" => "Despliegue de aplicaciones web",
        "DIW" => "Diseño de interfaces web", "DWEC" => "Desarrollo web en entorno cliente",
        "DWES" => "Desarrollo web en entorno servidor", "EED" => "Entornos de desarrollo",
        "EIE" => "Empresa e iniciativa emprendedora", "FOL" => "Formación y Orientación Laboral",
        "LLMM" => "Lenguaje de marcas", "PROG" => "Programación",
        "SSII" => "Sistemas informáticos", "HLC" => "Horas de libre configuración"],
    "DAM" => ["BBDD" => "Bases de datos", "EED" => "Entornos de desarrollo",
        "LLMM" => "Lenguaje de marcas", "PROG" => "Programación",
        "SSII" => "Sistemas informáticos", "FOL" => "Formación y Orientación Laboral",
        "EIE" => "Empresa e iniciativa emprendedora", "AD" => "Acceso a datos",
        "DI" => "Desarrollo de interfaces", "PSP" => "Programación de servicios y procesos",
        "PMDM" => "Programación multimedia y dispositivos móviles", "SGE" => "Sistemas de gestión empresarial"],
    "SMR" => ["MOMAE" => "Montaje y mantenimiento de equipos", "SOM" => "Sistemas operativos monopuesto",
        "APLOF" => "Aplicaciones ofimáticas", "REDLO" => "Redes locales", "FOL" => "Formación y orientación laboral",
        "EINEM" => "Empresa e iniciativa emprendedora", "SEGIN" => "Seguridad informática", "SERRE" => "Servicios en red",
        "SOR" => "Sistemas operativos en red", "HLC" => "Horas de libre configuración", "APLWE" => "Aplicaciones web"]
];

$listaModulos = (array_keys($ciclos));

if (isset($_POST['enviando'])) {

    $ciclo = $_POST['ciclo'];

    if ($ciclo == "") {
        $text = "Debes introducir el código de un ciclo formativo";
        $estilo = "no_validado";
    } elseif (!array_key_exists($ciclo, $ciclos)) {
        $text = "El código del ciclo formativo es incorrecto";
        $estilo = "no_validado";
    } else {
        $text = "Bienvenido al ciclo formativo " . $ciclo . ".   Los módulos de este ciclo son los siguientes: " . $listaModulos;
        $estilo = "validado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Módulos de FP Informática
        </title>
        <style>

            .no_validado{
                font-size:18px;
                color:#F00;
                font-weight:bold;
            }

            .validado{
                font-size:18px;
                color:#0C3;
                font-weight:bold;
            }

        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <h1>Módulos de FP Informática</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <p><label>Código del ciclo: <input type="text" name="ciclo" size="20" maxlength="20"></label></p>

            <p>
                <input type="submit" name="enviando" value="Enviar">
                <input type="reset" value="Borrar">
            </p>
        </form>

        <p class="<?= $estilo ?>"><?= $text ?></p>


    </body>
</html>
