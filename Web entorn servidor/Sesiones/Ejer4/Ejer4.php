<?php
    session_start();

    $dia = isset($_POST['dia']) ? $_POST['dia'] : null;
    $quincena = "";

    $d_anterior = $_SESSION["dia"] ?? "No hay datos";
    $q_anterior = $_SESSION["quincena"] ?? "No hay datos";

    if ($dia) {
        $fecha = new DateTime($dia);
        $dia_numero = (int)$fecha->format("d");

        if ($dia_numero <= 15) {
            $quincena = "primera";
        } else {
            $quincena = "segunda";
        }

        $_SESSION["dia"] = $dia;
        $_SESSION["quincena"] = $quincena;
    }

    echo "Valores actuales: <br>";
    echo "Día " . $dia . " " . $quincena . " quincena.<br><br>" ;

    echo "Valores anteriores: <br>";
    echo "Día " . $d_anterior . " " . $q_anterior . " quincena.<br><br>" ;

?>