<?php
    session_start();

    $n_anterior = $_SESSION["numero"] ?? null;
    $o_anterior = $_SESSION["operacion"] ?? null;
    $n2_anterior = $_SESSION["numero2"] ?? null;

    $n_actual = $_POST["numero"] ?? null;
    $o_actual = $_POST["operacion"] ?? null;
    $n2_actual = $_POST["numero2"] ?? null;

    if ($n_actual && $o_actual && $n2_actual) {
        $_SESSION["numero"] = $n_actual;
        $_SESSION["operacion"] = $o_actual;
        $_SESSION["numero2"] = $n2_actual;
    }

    echo "Valores actuales<br>";
    echo "Numero actual: " . ($n_actual ?? "No enviado") . "<br>";
    echo "Operacion actual: " . ($o_actual ?? "No enviado") . "<br>";
    echo "Numero actual: " . ($n2_actual ?? "No enviado") . "<br><br>";

    echo "Valores anteriores<br>";
    echo "Numero anterior: " . ($n_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Operacion anterior: " . ($o_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Numero anterior: " . ($n2_anterior ?? "No hay datos anteriores") . "<br><br>";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer3</title>
</head>
<body>
    <form action="Ejer3.php" method="post">

        <label>Número: </label>
        <input type="number" id="numero" name="numero" required><br><br>

        <label>Operación: </label>
        <select id="operacion" name="operacion" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>

        <label>Número: </label>
        <input type="number" id="numero2" name="numero2" required><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>
</html>

