


<?php

//Definimos las variables
/*Array de colores con su codigo asociado */

$codColor = "black";

$arrayColores = ['Marron' => '#804000', 'Azul' => '#33c0ff','Naranja' => '#ff8533 '];

//Capturo la información del formulario

if (isset($_POST ['Enviar'])){
    
    
    $codColor = $_POST['color'];
    
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body bgcolor=<?=$codColor?>>
        <form action="<?= $_SERVER[`PHP_SELF`]?>" method="POST">
            
            <select name="color">
                
                <?php foreach ($arrayColores as $nombreColor => $codigoColor): ?>

                <?php if($codigoColor==$codColor): ?>
                
                      <option selected value="<?=$codigoColor?>" > <?=$nombreColor?> </option>
                     
                 <?php else: ?>  
                      
                      <option value="<?=$codigoColor?>" > <?=$nombreColor?> </option>

                
               <?php  endif; ?>
                
                                 
                <?php endforeach; ?>
                 
            </select>
            <br>
            <br>
            <input type="submit" value="Enviar" name="Enviar" />
        </form>    
           
        <?= $codColor ?>
    </body>
</html>
