<?php

    $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
    $numero2 = isset($_POST['numero2']) ? $_POST['numero2'] : null;
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : null;

    $n_anterior = $_COOKIE["numero"] ?? null;
    $n2_anterior = $_COOKIE["numero2"] ?? null;
    $o_anterior = $_COOKIE["operacion"] ?? null;

    $resultado;
    $r_anterior = $_COOKIE["resultado" ?? null];

    if ($operacion === "+") {
        $resultado = $numero + $numero2;
    } else if ($operacion === "-") {
        $resultado = $numero - $numero2;
    } else if ($operacion === "*") {
        $resultado = $numero * $numero2;
    } else if ($operacion === "/") {
        $resultado = $numero / $numero2;
    }


    echo "Valores actuales: <br>";
    echo $numero . " " . $operacion . " " . $numero2 . " = " . $resultado."<br><br>" ;

    echo "Valores anteriores: <br>";
    echo $n_anterior . " " . $o_anterior . " " . $n2_anterior . " = " . $r_anterior."<br><br>" ;


    setcookie("numero", $numero, time() + (60*60*24 * 30), "/");
    setcookie("numero2", $numero2, time() + (60*60*24 * 30), "/");
    setcookie("operacion", $operacion, time() + (60*60*24 * 30), "/");
    setcookie("resultado", $resultado, time() + (60*60*24 * 30), "/");

?>
