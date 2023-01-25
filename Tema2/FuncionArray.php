

<?php

require './Funciones.php';

?>
<html>
    <!-- Funcion que recibe un array de numeros y dos limites 
   (superior e inferior) y devuelve otro array con los elementos 
   entre ambos limites.-->
    <head>
        <meta charset="UTF-8">
        <title>   Ejercicio 3 </title>
    </head>  
    <body>
        <?php


        $arraySalida = [4,7,1,8,3];
        $max = 8;
        $min = 1;
        $newArray;
        
        imprimeArray($arraySalida);
        echo "<br>";
        $newArray= filtraVector($arrayOriginal, $max, $min);
        imprimeArray($arraySalida);
        echo "<br>";
        

        ?>
    </body>
</html>
