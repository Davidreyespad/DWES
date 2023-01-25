<!DOCTYPE html>
<?php

$arrayBits = [];
$arrayBitsInverso= [];
define ('NUMBITS', 10);

//generamos el array de bits
for($i= 0;$i < NUMBITS; $i++){
    $arrayBits[] = rand (0,1);
}
    //cambiamos los 1 por los 0 y al reves  
    for ($i=0;$i<10;$i++){
        if ($arrayBits[$i]==1){
                $arrayBitsInverso[$i]=0;
        }else{
            $arrayBitsInverso[$i]=1;
        }
    }
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <?php for($i=0;$i<NUMBITS;$i++):?>
                    <td><?=$arrayBits[$i] ?></td>
                <?php endfor; ?>
            </tr>
        </table>
    </body>
</html>
