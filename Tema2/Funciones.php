<?php

function filtraVector ($arrayOriginal, $max, $min){
    
    $indice=0;
    $arraySalida = [];
    
    while ($indice < count($arrayOriginal)){
        if($arrayOriginal[$indice] >= $min && $arrayOriginal[$indice] <= $max){
            $arraySalida[]=$arrayOriginal[$indice];
        }
        $indice++;
    }
    return $arraySalida;
}

function imprimeArray($arraySalida){
    foreach ($arraySalida as $value){
        echo "$value". "";
    }
}

?>