<?php
    session_start();

    $n_anterior = $_SESSION["nombre"] ?? null;
    $i_anterior = $_SESSION["idioma"] ?? null;
    $co_anterior = $_SESSION["color"] ?? null;
    $ci_anterior = $_SESSION["ciudad"] ?? null;

    $n_actual = $_POST["nombre"] ?? null;
    $i_actual = $_POST["idioma"] ?? null;
    $co_actual = $_POST["color"] ?? null;
    $ci_actual = $_POST["ciudad"] ?? null;

    if ($n_actual && $i_actual && $co_actual && $ci_actual) {
        $_SESSION["nombre"] = $n_actual;
        $_SESSION["idioma"] = $i_actual;
        $_SESSION["color"] = $n_actual;
        $_SESSION["ciudad"] = $i_actual;
    }

    echo "Valores actuales<br>";
    echo "Nombre actual: " . ($n_actual ?? "No enviado") . "<br>";
    echo "Idioma actual: " . ($i_actual ?? "No enviado") . "<br>";
    echo "Color actual: " . ($co_actual ?? "No enviado") . "<br>";
    echo "Color actual: " . ($ci_actual ?? "No enviado") . "<br><br>";

    echo "Valores anteriores<br>";
    echo "Nombre anterior: " . ($n_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Idioma anterior: " . ($i_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Color anterior: " . ($co_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Ciudad anterior: " . ($ci_anterior ?? "No hay datos anteriores") . "<br><br>";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer2</title>
</head>
<body>
    <form action="Ejer2.php" method="post">
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label>Idioma: </label><br>
        <input type="radio" id="espaniol" name="idioma" value="Español" required>
        <label for="espaniol">Español</label>
        <input type="radio" id="ingles" name="idioma" value="Inglés">
        <label for="ingles">Inglés</label>
        <input type="radio" id="otro" name="idioma" value="Otro">
        <label for="otro">Otro</label>
        <input type="text" name="idioma-otro"><br><br>

        <label>Color: </label>
        <input type="text" id="color" name="color" required><br><br>

        <label>Ciudad: </label>
        <input type="text" id="ciudad" name="ciudad" required><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>

