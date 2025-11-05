<?php

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $idioma = isset($_POST['idioma']) ? $_POST['idioma'] : null;
    $idioma_otro = isset($_POST['idioma-otro']) ? $_POST['idioma-otro'] : null;
    $color = isset($_POST['color']) ? $_POST['color'] : null;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;

    $n_anterior = $_COOKIE["nombre"] ?? null;
    $i_anterior = $_COOKIE["idioma"] ?? null;
    $c_anterior = $_COOKIE["color"] ?? null;
    $ci_anterior = $_COOKIE["ciudad"] ?? null;

    if ($idioma == "Otro" && !empty($idioma_otro)) {
        $i_actual = $idioma_otro;
    } else {
        $i_actual = $idioma;
    }

    $c_actual = $color;
    $ci_actual = $ciudad;

    echo "<br>Valores actuales:<br>";
    echo "Nombre: $nombre<br>";
    echo "Idioma: $i_actual<br>";
    echo "Color: $c_actual<br>";
    echo "Ciudad: $ci_actual<br>";

    echo "<br>Valores anteriores:<br>";
    echo "Nombre: $n_anterior<br>";
    echo "Idioma: $i_anterior<br>";
    echo "Color: $c_anterior<br>";
    echo "Ciudad: $ci_anterior<br><br>";

    setcookie("nombre", $nombre, time() + (60*60*24 * 30), "/");
    setcookie("idioma", $i_actual, time() + (60*60*24 * 30), "/");
    setcookie("color", $c_actual, time() + (60*60*24 * 30), "/");
    setcookie("ciudad", $ci_actual, time() + (60*60*24 * 30), "/");

?>
