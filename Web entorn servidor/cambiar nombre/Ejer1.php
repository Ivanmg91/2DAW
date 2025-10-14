<?php
    $valorConvertir = 166.386;
    $cantidad = $_POST["cantidad"];
    $convertir = $_POST["convertir"];

    if ($convertir == "pesetas") {
        $resultado = $cantidad * $valorConvertir;
        echo $resultado;
    } elseif ($convertir == "euros") {
        $resultado = $cantidad / $valorConvertir;
        echo $resultado;
    }
?>