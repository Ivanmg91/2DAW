<?php
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $nivelEstudio = isset($_POST['nivel-estudio']) ? $_POST['nivel-estudio'] : null;
    $situacion = isset($_POST['situacion-actual']) ? $_POST['situacion-actual'] : [];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

    echo "<h2>$nombre</h2>";
    echo "Nivel de estudio: $nivelEstudio<br>";
    echo "Situación actual: ";
    foreach ($situacion as $sit) {
        echo $sit . " ";
    }
    echo "<br>Aficiones: ";
    foreach ($hobbies as $hobbie) {
        echo $hobbie . " ";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer9</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>
