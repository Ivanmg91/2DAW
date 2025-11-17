<?php

    function calcularMedia($numeros) {
        $cantidad = count($numeros);
        if ($cantidad === 0) {
            return 0;
        }
        $suma_numeros = 0;

        foreach ($numeros as $numero) {
            $suma_numeros += $numero;
        }

        return $suma_numeros / $cantidad;
    }

    function calcularMediana($numeros) {
        sort($numeros, SORT_NUMERIC);
        $x = count($numeros);

        return $x % 2 == 0 ? array_sum(array_slice($numeros, ($x/2) - 1, 2)) / 2 : array_slice($numeros, $x/2, 1) [0];
    }

    function calcularModa($numeros) {
        $valores = array_count_values($numeros);
            if (empty($valores)) {
            return "No hay números para calcular la moda";
        }

        $maximo = max($valores);

        $moda = [];
        foreach ($valores as $numero => $frecuencia) {
            if ($frecuencia == $maximo) {
                $moda[] = $numero;
            }
        }

        return count($moda) === 1 ? $moda[0] : $moda;
    }


    $numeros = isset($_POST['numeros']) ? $_POST['numeros'] : [];
    // Primero, muestra el valor de la cookie para comprobar qué contiene
if (isset($_COOKIE["numeros"])) {
    echo "Valor de la cookie antes de decodificar: " . $_COOKIE["numeros"] . "<br>";
}

$numeros_anterior = isset($_COOKIE["numeros"]) && is_string($_COOKIE["numeros"]) 
                    ? json_decode($_COOKIE["numeros"], true) 
                    : [];

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error en la decodificación del JSON: " . json_last_error_msg();
    $numeros_anterior = [];
}

// Si el array no está vacío, convierte los valores a números (puede ser 'intval' o 'floatval')
if (!empty($numeros_anterior)) {
    $numeros_anterior = array_map('intval', $numeros_anterior); // Usar 'floatval' si son decimales
}

// Muestra el array después de convertirlo
echo "<pre>";
var_dump($numeros_anterior); // Verifica qué contiene el array después de la conversión
echo "</pre>";

// Resto del código...
setcookie("numeros", json_encode($numeros), time() + (60 * 60 * 24 * 30), "/");

echo "ACTUAL<br>";
echo "Media = " . calcularMedia($numeros);
echo "<br>Mediana = " . calcularMediana($numeros);
echo "<br>Moda = " . calcularModa($numeros);
    
echo "<br><br>ANTERIOR<br>";
echo "Media = " . calcularMedia($numeros_anterior);
echo "<br>Mediana = " . calcularMediana($numeros_anterior);
echo "<br>Moda = " . calcularModa($numeros_anterior);

    ?>