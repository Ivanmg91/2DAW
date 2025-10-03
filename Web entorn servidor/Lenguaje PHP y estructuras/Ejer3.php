<?php

function salarioMaximo($trabajadores) {
    return max($trabajadores);
}

function salarioMinimo($trabajadores) {
    return min($trabajadores);
}

function salarioMedio($trabajadores) {
    $sumar = 0;

    foreach ($trabajadores as $salario) {
        $sumar += $salario;
    }

    $cantidad = count($trabajadores);

    if ($cantidad === 0) {
        return 0;
    }
    return $sumar / $cantidad;
}


function mostrarTrabajadores($trabajadores) {
    foreach ($trabajadores as $nombre => $salario) {
        echo "Nombre: $nombre - Salario: $salario\n";
    }
    echo "\n";
}

$trabajadores = [];

echo "Introduce número de trabajadores ";
$cantidad = (int) trim(fgets(STDIN));

for ($i = 0; $i < $cantidad; $i++) {
    echo "Introduce el nombre del trabajador " . ($i+1) . ": "; //los puntos son para concatenar
    $nombre = trim(fgets(STDIN));

    echo "Introduce el salario de $nombre: ";
    $salario = (float) trim(fgets(STDIN));

    $trabajadores[$nombre] = $salario;
}

echo "\n--- Salarios Iniciales ---\n";
mostrarTrabajadores($trabajadores);

echo "Salario máximo: " . salarioMaximo($trabajadores) . "\n";
echo "Salario mínimo: " . salarioMinimo($trabajadores) . "\n";
echo "Salario promedio: " . salarioMedio($trabajadores) . "\n";

echo "\nIntroduce el porcentaje de incremento salarial: ";
$incremento = (float) trim(fgets(STDIN));

foreach ($trabajadores as $nombre => $salario) {
    $trabajadores[$nombre] = $salario + ($salario * $incremento / 100);
}

echo "\n--- Salarios Después del Incremento ---\n";
mostrarTrabajadores($trabajadores);

echo "Salario máximo: " . salarioMaximo($trabajadores) . "\n";
echo "Salario mínimo: " . salarioMinimo($trabajadores) . "\n";
echo "Salario promedio: " . salarioMedio($trabajadores) . "\n";
?>

<!-- Q SE PUEDA RELLENAR POR PANTALLA -->