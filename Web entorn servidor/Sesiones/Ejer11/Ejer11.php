<?php
    session_start();

    $_SESSION['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $_SESSION['nivelEstudio'] = isset($_POST['nivel-estudio']) ? $_POST['nivel-estudio'] : null;
    $_SESSION['situacion'] = isset($_POST['situacion-actual']) ? $_POST['situacion-actual'] : [];
    $_SESSION['hobbies'] = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

    echo "<h2>" . $_SESSION['nombre'] . "</h2>";
    echo "Nivel de estudio:" . $_SESSION['nivelEstudio'] . "<br>";
    echo "Situación actual: ";
    foreach ($_SESSION['situacion'] as $sit) {
        echo $sit . " ";
    }
    echo "<br>Aficiones: ";
    foreach ($_SESSION['hobbies'] as $hobbie) {
        echo $hobbie . " ";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer11</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>
