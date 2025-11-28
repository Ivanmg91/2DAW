<?php
    session_start();

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
    $numeros_anterior = isset($_SESSION["numeros"]) && is_string($_SESSION["numeros"]) ? json_decode($_SESSION["numeros"], true) : [];

    $_SESSION["numeros"] = json_encode($numeros);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ACTUAL</h2>
    <p>
        Valores actuales: <?php echo is_array($numeros) && count($numeros) ? implode(", ", $numeros) : "Ninguno" ?><br>
        Media = <?php echo calcularMedia($numeros); ?><br>
        Mediana = <?php echo calcularMediana($numeros) ?><br>
        Moda = <?php echo calcularModa($numeros); ?><br>
    </p>

    <h2>ANTERIOR</h2>
    <p>
        Valores anteriores: <?php echo is_array($numeros_anterior) && count($numeros_anterior) ? implode(", ", $numeros_anterior) : "Ninguno" ?><br>
        Media = <?php echo calcularMedia($numeros_anterior); ?><br>
        Mediana = <?php echo calcularMediana($numeros_anterior) ?><br>
        Moda = <?php echo calcularModa($numeros_anterior); ?><br>
    </p>

    <p><a href="index.html">Volver</a></p>
</body>
</html>