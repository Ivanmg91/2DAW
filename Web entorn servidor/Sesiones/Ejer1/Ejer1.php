<?php
    session_start();

    $u_anterior = $_SESSION["usuario"] ?? null;
    $a_anterior = $_SESSION["accion"] ?? null;

    $u_actual = $_POST["nombre"] ?? null;
    $a_actual = $_POST["accion"] ?? null;

    if ($u_actual && $a_actual) {
        $_SESSION["usuario"] = $u_actual;
        $_SESSION["accion"] = $a_actual;
    }

    echo "Valores actuales<br>";
    echo "Usuario actual: " . ($u_actual ?? "No enviado") . "<br>";
    echo "Acción actual: " . ($a_actual ?? "No enviada") . "<br><br>";

    echo "Valores anteriores<br>";
    echo "Usuario anterior: " . ($u_anterior ?? "No hay datos anteriores") . "<br>";
    echo "Acción anterior: " . ($a_anterior ?? "No hay datos anteriores") . "<br><br>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer1</title>
</head>
<body>
    <form action="Ejer1.php" method="post">
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <input type="radio" name="accion" value="Saludo" required> Saludo
        <input type="radio" name="accion" value="Despedida" required> Despedida

        <br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
