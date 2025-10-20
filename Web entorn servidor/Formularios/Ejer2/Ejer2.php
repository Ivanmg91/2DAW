<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $horas = intval($_POST['horas']);
    $verMensual = isset($_POST['mensual']) ? true : false;

    if ($horas <= 40) {
        $salarioSemanal = $horas * 12;
    } else {
        $salarioSemanal = (40 * 12) + (($horas - 40) * 16);
    }

    if ($verMensual) {
        $salarioMensual = $salarioSemanal * 4;
        $salarioMensual = number_format($salarioMensual, 2, '.', ',');
        echo "<p>Salario mensual: €$salarioMensual</p>";
    }

    $salarioSemanal = number_format($salarioSemanal, 2, '.', ',');
    echo "<p>Salario semanal: €$salarioSemanal</p>";
} else {
    echo "<p>Error: no se ha recibido la información del formulario.</p>";
}
?>
