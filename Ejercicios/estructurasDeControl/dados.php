<?php
        
        $dado1= rand(1,6);
        $dado2= rand(1,6);
        $dado3= rand(1,6);
        $resto;
        $max;
        $min;
        $texto = ' error ';
        
        echo "Dado 1: $dado1 <br>"; 
        echo "Dado 2: $dado2 <br>";
        echo "Dado 3: $dado3 <br> <br>";
            
        
        if ($dado1 === $dado2 && $dado2 === $dado3 && $dado1==$dado3){
            // si los 3 dados son iguales, son trios
            $texto= "Trio de $dado1";
        }elseif ($dado1 == $dado2 || $dado1 == $dado3){
            $texto="Pareja de $dado1";
            
        } elseif ($dado2 == $dado3){
            $texto="Pareja de $dado2";
            
        }else {
            $max =max($dado1,$dado2, $dado3);
            $min =min($dado1,$dado2,$dado3);
            $resto = $max- $min;
            /*if ($dado1 > $dado2){
              if ($dado1 > $dado3){
                  if ($dado2 > $dado3){
                  $maximo = $dado1;
                  $min = $dado3;
                  
                 }
              }  else {
                  $maximo = $dado3;
                  $min = $dado1;
              }
            } else {
                if($dado2>$dado3){
                    $maximo = $dado2;
                    $min = $dado3;
                } else {
                    $maximo = $dado3;
                    $min = $dado2;
                }
            }*/
            
            $resto = $max - $min;
            $texto = "El dado mayor es $max y el dado menor es $min y el resto es $resto";
        }
        ?>            
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p>
        
        <img src="./img/<?= $dado1 ?>.svg">
        <img src="./img/<?= $dado2 ?>.svg">
        <img src="./img/<?= $dado3 ?>.svg">
        
        <p> <?=$texto?> </p>
        
    </body>
</html>
