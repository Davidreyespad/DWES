<?php

$pintarTabla = false;
$mensaje = " ";

if (isset($_POST ['Enviar'])) {

    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    if ($filas == "" || $filas == " ") {
        $pintarTabla;
        $mensaje ="Introduzca un número";
    }elseif (!ctype_digit($filas)) {
     
        $mensaje = "No es un número entero positivo";
        
    }elseif($filas < 0 || $filas > 200) {
    
        $mensaje ="Rango supeior";
        
    }else {
        $pintarTabla=true;
    }
}
?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla de una columna (Formulario).
     </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla de una columna (Formulario)</h1>

  <form action="tabla_columna.php" method="post">
    <p>Escriba un número (0 &lt; número &le; 200) y mostraré una tabla de una columna
      y tantas filas como indique.
    </p>

    <p><label>Número de filas: <input type="number" name="filas" min="1" max="200" value="10"></label></p>
    <p><label>Número de columnas: <input type="number" name="columnas" min="1" max="200" value="10"></label></p>

    
    <p>
      <input type="submit" name="Enviar" value="Mostrar">
      <input type="reset" value="Borrar">
    </p>
  </form>
  
  <?php if ($pintarTabla): ?>      

            <table border="1">
                    
                
                <?php for($i = 1; $i <= $filas; $i++):?>
                
                    <tr>
                        <?php for($c = 1; $c <= $columnas; $c++):?>
                            <td> <?="$i-$c"?> </td>
                        <?php endfor;?>
                    </tr>               
                
                <?php endfor;?>
            </table>   

        <?php else:?> 
            <p> <?= $mensaje ?> </p>  <!--error--> 
        <?php endif;?>
</body>
</html>


