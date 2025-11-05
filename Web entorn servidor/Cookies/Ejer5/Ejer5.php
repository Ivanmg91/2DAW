<?php

    $dia = isset($_POST['dia']) ? $_POST['dia'] : null;
    $quincena;

    $d_anterior = $_COOKIE["dia"] ?? null;
    $q_anterior = $_COOKIE["quincena"] ?? null;


    $fecha = new DateTime($dia);
    $dia_numero = (int)$fecha->format("d");

    if ($dia_numero <= 15) {
        $quincena = "primera";
    } else {
        $quincena = "segunda";
    }


    echo "Valores actuales: <br>";
    echo "Día " . $dia . " " . $quincena . " quincena.<br><br>" ;

    echo "Valores anteriores: <br>";
    echo "Día " . $d_anterior . " " . $q_anterior . " quincena.<br><br>" ;


    setcookie("dia", $dia, time() + (60*60*24 * 30), "/");
    setcookie("quincena", $quincena, time() + (60*60*24 * 30), "/");

?>
