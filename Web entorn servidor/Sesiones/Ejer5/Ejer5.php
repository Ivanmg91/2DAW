<?php
    session_start();

    $ca_anterior = $_SESSION["cantidad"] ?? null;
    $co_anterior = $_SESSION["convertir"] ?? null;
    $r_anterior = $_SESSION["resultado"] ?? null;

    $valorConvertir = 166.386;
    $cantidad = $_POST["cantidad"];
    $convertir = $_POST["convertir"];
    $resultado = 0;

    if ($convertir == "pesetas") {
        $resultado = $cantidad * $valorConvertir;
        $mensaje_actual = "$cantidad € son $resultado Pesetas";
    } else {
        $resultado = $cantidad / $valorConvertir;
        $mensaje_actual = "$cantidad Pesetas son $resultado Euros";
    }

    if ($cantidad) {
        $_SESSION["cantidad"] = $cantidad;
        $_SESSION["convertir"] = $convertir;
        $_SESSION["resultado"] = $resultado;
    }

    echo "ACTUAL<br>";
    echo $mensaje_actual . "<br><br>";

    echo "ANTERIOR<br>";
    if ($r_anterior != null) {
        if ($co_anterior == "pesetas") {
            echo "$ca_anterior € eran $r_anterior Pesetas<br>";
        } else {
            echo "$ca_anterior Pesetas eran $r_anterior Euros<br>";
        }
    } else {
        echo "No hay datos anteriores.<br>";
    }
    
    echo "<br><a href='index.html'>Volver</a>";
?>