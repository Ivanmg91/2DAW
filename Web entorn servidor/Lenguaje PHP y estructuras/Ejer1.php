<?php
function CalcularPotencia($base, $exponenteMax) {
    $sumar = 0;

    for ($i = 1; $i <= $exponenteMax; $i++) {
        $potencia = pow($base, $i);
        $sumar += $potencia;

        echo "$base ^ $i = $potencia";
    }
    echo "Suma de potencias: $sumar";
}

CalcularPotencia(3, 3);
?>

<!-- REVISAR -->