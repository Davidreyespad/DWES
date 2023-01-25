<?php

$pintarTabla = false;
$mensaje = " ";

if (isset($_POST ['mostrando'])) {

    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    if ($filas == "" || $columnas == "") {
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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if ($pintarTabla == true): ?>      

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

