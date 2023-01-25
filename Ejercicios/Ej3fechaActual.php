<!DOCTYPE html>
<?php
//$fechaActual = date ('w-d-m-Y');
$diaSemanaActual = date('l');     //devuelve el dia de la semana en numero 
$mesActual = date('n');    //devuelve el mes con digitos
$anioActual = date('Y');   //devuelve el año con 4 digitos
$diaActual = date('d');      //devuelve el dia del mes con dígitos
//$arrayDiaSemana=['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
$arrayMes
 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 
'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

$arrayAsocMes = [
    'Monday' => 'Lunes',
    'Tuesday' => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday' => 'Jueves',
    'Friday' => 'Viernes',
    'Saturday' => 'Sábado',
    'Sunday' => 'Domingo'
];

//Para escribir, podemos ir concatenando con $mensaje.=....
$mensaje = $arrayAsocMes[$diaSemanaActual] . ", ";
$mensaje .= $diaActual . " de ";
$mensaje .= $arrayMes[$mesActual - 1] . " de ";
$mensaje .= date('Y');   //$mensaje.=$anioActual; es lo mismo
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p><?= $mensaje ?></p>
    </body>
</html>