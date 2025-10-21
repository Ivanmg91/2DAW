<?php

$trabajadores = [
    "Ivan" => 1200.50,
    "Pablo" => 1800,
    "Carlos" => 1500,
    "Andres" => 2000,
    "Gonzalo" => 1700
];

$operaciones = isset($_POST['operaciones']) ? $_POST['operaciones'] : [];
$porcentaje = isset($_POST['porcentaje']) ? floatval($_POST['porcentaje']) : 0;

echo "<h2>Salarios originales y con porcentaje del $porcentaje%</h2>";

foreach ($trabajadores as $nombre => $salario) {
    $salario_mod = $salario + ($salario * $porcentaje / 100);
    echo "$nombre: Original = $salario euros, Modificado = " . number_format($salario_mod, 2) . " euros<br>";
}

echo "<h2>Tipos de salarios:</h2>";

foreach ($operaciones as $operacion) {

    if ($operacion == "salarioMaximo") {

        $max = max($trabajadores);
        $nombre_max = array_search($max, $trabajadores);
        echo "<p>Salario máximo: $nombre_max con $$max</p>";

    } elseif ($operacion == "salarioMinimo") {

        $min = min($trabajadores);
        $nombre_min = array_search($min, $trabajadores);
        echo "<p>Salario mínimo: $nombre_min con $$min</p>";

    } elseif ($operacion == "salarioMedio") {

        $suma = array_sum($trabajadores);
        $promedio = $suma / count($trabajadores);
        echo "Salario medio: $" . number_format($promedio, 2);

    }

}

?>
