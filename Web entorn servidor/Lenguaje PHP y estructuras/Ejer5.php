<?php

$matriz = array();
$numeroFilas = 5;
$numeroColumnas = 5;

for ($n = 0; $n < $numeroFilas; $n++) {
    $fila = [];

    for ($m = 0; $m < $numeroColumnas; $m++) {
        $nm = $n + $m;
        $fila[$m] = $nm;
    }

    $matriz[] = $fila;
}


echo "<table border='1' style='border-collapse: collapse;'>";
foreach ($matriz as $fila) {
    echo "<tr>";
    foreach ($fila as $numero) {
        echo "<td style='padding: 10px; text-align: center;'>$numero</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>