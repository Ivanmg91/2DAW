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
    $numeros_anterior = isset($_COOKIE["numeros"]) && is_string($_COOKIE["numeros"]) ? json_decode($_COOKIE["numeros"], true) : [];

    setcookie("numeros", json_encode($numeros), time() + (60 * 60 * 24 * 30), "/");

    echo "ACTUAL<br>";
    echo "<br>Valores actuales = " . (is_array($numeros) && count($numeros) ? implode(", ", $numeros) : "Ninguno");
    echo "Media = " . calcularMedia($numeros);
    echo "<br>Mediana = " . calcularMediana($numeros);
    echo "<br>Moda = " . calcularModa($numeros);
        
    echo "<br><br>ANTERIOR<br>";
    echo "<br>Valores anteriores = " . (is_array($numeros_anterior) && count($numeros_anterior) ? implode(", ", $numeros_anterior) : "Ninguno");
    echo "Media = " . calcularMedia($numeros_anterior);
    echo "<br>Mediana = " . calcularMediana($numeros_anterior);
    echo "<br>Moda = " . calcularModa($numeros_anterior);

?>