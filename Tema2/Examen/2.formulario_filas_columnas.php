<!DOCTYPE html>
<?php

$mensaje = " ";
$pintarTabla = false;

if (isset($_POST['mostrando'])) {
    
    $filas = $_POST['filas'];
    $columnas =$_POST['columnas'];
       
    if ($filas == "" || $columnas == "") {
        $mensaje= "Hay un error";
    }elseif (!ctype_digit ($filas) || !ctype_digit($columnas)){
        $mensaje = "Solo se admiten numero enteros positivos";
    } elseif ($filas < 0 || $filas >= 100 || $columnas < 0 || $columnas >= 100){
        $mensaje = "El número debe ser superior a 0 o inferior de 100";
    } else {
        $pintarTabla = true;
    }   
}
    
?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla filas x columnas (Formulario).
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla numerada (Formulario)</h1>
  <form action="tabla_filas_columnas.php" method="post"> <!-- tabla_filas_columnas.php -->
    <p>Escriba dos números y mostraré una tabla con el número de columnas
      (0 &lt; columnas &le; 100) y de filas (0 &lt; numeradas &le; 100) que indique.
    </p>

    
    <table>
      <tbody>
        <tr>
          <td><label for="columnas">Número de columnas:</label></td>
          <td><input type="text" name="columnas"></td>
        </tr>
        <tr>
          <td><label for="numeradas">Número de filas:</label></td>
          <td><input type="text" name="filas"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar" name="mostrando">
      <input type="reset" value="Borrar">
    </p>
  </form>
  
    <?php
    
    echo "<p class=\"aviso\">$mensaje</p>\n";
  
    ?>
</body>
</html>
