<?php
$mensaje = "Error";
$estilo = "rojo";
$edad = "";
$usuario = "";

if (isset($_POST ['enviando'])) {

    $edad = $_POST['edad'];
    $usuario = $_POST['usuario'];

    if ($edad == "" || $usuario == "") {
        $mensaje = "Tiene que introducir una edad o nombre válida";
    } else {
        if (!ctype_digit($edad)) { /* cae en examen ctype_digit */
            $mensaje = "Usted no ha introducido un número entero o positivo";
        } elseif ($edad < 10) {
            $mensaje = "Eres demasiado joven.";
            $estilo = "rojo";
        } elseif ($edad >= 10 && $edad <= 20) {
            $mensaje = "Qué mala edad tienes.";
            $estilo = "rojo";
        } elseif ($edad >= 21 && $edad <= 30) {
            $mensaje = "Estas en el mejor momento.";
            $estilo = "rojo";
        } elseif ($edad > 31) {
            $mensaje = "Qué bien te veo.";
            $estilo = "verde";
        }
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario edad</title>
        <style>
            h1{
                text-align:center;
            }

            table{
                background-color:#FFC;
                padding:5px;
                border:#666 5px solid;
            }

            .rojo{
                font-size:18px;
                color:#F00;
                font-weight:bold;
                text-align:center;
            }

            .verde{
                font-size:18px;
                color:#0C3;
                font-weight:bold;
                text-align:center;
            }


        </style>
    </head>

    <body>
        <h1>INTRODUCE TU EDAD</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="datos_usuario" id="datos_usuario">
            <table width="15%" align="center">
                <tr>
                    <td>Nombre:</td>
                    <td><label for="nombre_usuario"></label>
                        <input type="text" name="usuario" id="usuario"></td>
                </tr>
                <tr>
                    <td>Edad:</td>
                    <td><label for="edad_usuario"></label>
                        <input type="text" name="edad" id="edad"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="enviando" id="enviando" value="Enviar"></td>
                </tr>
            </table>
        </form>

        <p class="<?= $estilo ?>"> <?= $mensaje ?></p>

    </body>
</html>
