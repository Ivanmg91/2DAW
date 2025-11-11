<?php
    $valorConvertir = 166.386;
    $cantidad = $_POST["cantidad"];
    $convertir = $_POST["convertir"];
    $resultado = null;

    $ca_anterior = $_COOKIE["cantidad"] ?? null;
    $co_anterior = $_COOKIE["convertir"] ?? null;
    $r_anterior = $_COOKIE["resultado"] ?? null;

    if ($convertir == "pesetas") {

        $resultado = $cantidad * $valorConvertir;
        echo "ACTUAL<br>";
        echo "$cantidad" . "€ " . " son $resultado $convertir. <br><br>";

        echo "ANTERIOR<br>";
        if ($r_anterior !== null) {
            echo "$ca_anterior" . "€ " . " son $r_anterior $co_anterior. <br>";
        } else {
            echo "No hay un resultado anterior.<br>";
        }
    } elseif ($convertir == "euros") {

        $resultado = $cantidad / $valorConvertir;
        echo "ACTUAL<br>";
        echo "$cantidad" . " pesetas " . " son $resultado $convertir. <br><br>";

        echo "ANTERIOR<br>";
        if ($r_anterior !== null) {
            echo "$ca_anterior" . " pesetas " . " son $r_anterior $co_anterior. <br>";
        } else {
            echo "No hay un resultado anterior.<br>";
        }
    }

    setcookie("cantidad", $cantidad, time() + (60*60*24 * 30), "/");
    setcookie("convertir", $convertir, time() + (60*60*24 * 30), "/");
    setcookie("resultado", $resultado, time() + (60*60*24 * 30), "/");
?>
