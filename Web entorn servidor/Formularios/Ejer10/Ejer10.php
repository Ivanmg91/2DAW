<?php
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $edad = isset($_POST['edad']) ? $_POST['edad'] : null;
    $peso = isset($_POST['peso']) ? $_POST['peso'] : null;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : null;
    $estadoCivil = isset($_POST['estado-civil-otro']) ? $_POST['estado-civil-otro'] : null;
    $aficiones = isset($_POST['aficiones']) ? $_POST['aficiones'] : [];

    echo "<h2>$nombre $apellidos</h2>";
    echo "Edad: $edad<br>";
    echo "Peso: $peso<br>";
    echo "Sexo: $sexo<br>";
    echo "Estado civil: $estadoCivil<br>";
    echo "Aficiones: ";
    foreach ($aficiones as $aficion) {
        echo $aficion . " ";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer10</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>
