<?php

// POR CONSOLA

function operaMatriz($matriz1, $matriz2, $operacion) {
    $resultado = [];

    if ($operacion === "s") {
        for ($i = 0; $i < count($matriz1); $i++) {
            for ($j = 0; $j < count($matriz1[$i]); $j++) {
                $resultado[$i][$j] = $matriz1[$i][$j] + $matriz2[$i][$j];
            }
        }
    } else if ($operacion === "r") {
        for ($i = 0; $i < count($matriz1); $i++) {
            for ($j = 0; $j < count($matriz1[$i]); $j++) {
                $resultado[$i][$j] = $matriz1[$i][$j] - $matriz2[$i][$j];
            }
        }
    } else if ($operacion === "m") {
        for ($i = 0; $i < count($matriz1); $i++) {
            for ($j = 0; $j < count($matriz2[0]); $j++) {
                $resultado[$i][$j] = 0;
                for ($k = 0; $k < count($matriz2); $k++) {
                    $resultado[$i][$j] += $matriz1[$i][$k] * $matriz2[$k][$j];
                }
            }
        }
    } else if ($operacion === "d") {
        $inversaMatriz2 = inversaMatriz($matriz2);
        $resultado = multiplicarMatrices($matriz1, $inversaMatriz2);
    }

    return $resultado;
}

function inversaMatriz($matriz) {
    $determinante = $matriz[0][0] * $matriz[1][1] - $matriz[0][1] * $matriz[1][0];

    if ($determinante == 0) {
        echo "La matriz no tiene inversa (determinante 0)\n";
        exit;
    }

    $inversa = [
        [$matriz[1][1] / $determinante, -$matriz[0][1] / $determinante],
        [-$matriz[1][0] / $determinante, $matriz[0][0] / $determinante]
    ];

    return $inversa;
}

function multiplicarMatrices($matriz1, $matriz2) {
    $resultado = [];

    for ($i = 0; $i < count($matriz1); $i++) {
        for ($j = 0; $j < count($matriz2[0]); $j++) {
            $resultado[$i][$j] = 0;
            for ($k = 0; $k < count($matriz2); $k++) {
                $resultado[$i][$j] += $matriz1[$i][$k] * $matriz2[$k][$j];
            }
        }
    }

    return $resultado;
}

function rellenaMatriz($filasYColumnas) {

    $matriz = [];

    for ($i = 0; $i < $filasYColumnas; $i++) {
        echo "Introduce los valores de la fila " . ($i + 1) . " separados por espacios: ";
        $valores = explode(" ", readline());

        if (count($valores) != $filasYColumnas) {
            echo "Error: la cantidad de valores no coincide con el número de columnas.\n";
            $i--;
            continue;
        }

        $matriz[] = array_map('intval', $valores);
    }

    return $matriz;
}

// INICIO PROGRAMA

echo "Indica el numero de filas (el número de columnas será el mismo): ";
$filasYColumnas = readline();

$matriz1 = rellenaMatriz($filasYColumnas);
echo "Siguiente matriz\n";
$matriz2 = rellenaMatriz($filasYColumnas);

echo "¿Qué operación quieres realizar: suma(s), resta(r), multiplicación(m) o división(d)?: ";
$operacion = readline();

while ($operacion !== "s" && $operacion !== "r" && $operacion !== "m" && $operacion !== "d") {
    echo "Debes introducir una de estas operaciones: suma(s), resta(r), multiplicación(m) o división(d)\n";
    $operacion = readline();
}

$matrizResultado = operaMatriz($matriz1, $matriz2, trim($operacion));
echo "Se van a $operacion las matrices:\n";
echo "Matriz 1:\n";
print_r($matriz1);
echo "Matriz 2:\n";
print_r($matriz2);
echo "El resultado es:\n";
print_r($matrizResultado);
?>