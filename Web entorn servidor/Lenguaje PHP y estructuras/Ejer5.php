<?php

$matriz = array();
$numeroFilas = 5;
$numeroColumnas = 5;

for ($n = 0; $n < $numeroFilas; $n++) {
    $fila = [];

    for ($m=0; $m < $numeroColumnas; $m++) { 
        $nm = $n + $m;
        $fila[$m] = $nm;
    }

    $matriz[] = $fila;
}

print_r($matriz);
?>

<!-- ME FALTA 1 LA 5 NO LA AÑADE -->