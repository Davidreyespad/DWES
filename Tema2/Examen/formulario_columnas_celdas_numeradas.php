<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla numerada (Formulario).
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla numerada (Formulario)</h1>
   <form action="tabla_columnas_celas.php" method="post">
    <p>Escriba dos números y mostraré una tabla con el número de columnas
      (0 &lt; columnas &le; 100) que indique y con las primeras celdas numeradas
      (0 &lt; numeradas &le; 100).
    </p>

    <table>
      <tbody>
        <tr>
          <td><label for="columnas">Número de columnas:</label></td>
          <td><input type="text" name="columnas"></td>
        </tr>
        <tr>
          <td><label for="numeradas">Número de celdas numeradas:</label></td>
          <td><input type="number" name="numeradas" min="1" max="1000"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar" name="mostrando">
      <input type="reset" value="Borrar">
    </p>
  </form>
</body>
</html>
