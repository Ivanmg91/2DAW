<?php
    $_SESSION['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $_SESSION['apellidos'] = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $_SESSION['nivelEstudio'] = isset($_POST['nivel-estudio']) ? $_POST['nivel-estudio'] : null;
    $_SESSION['nacionalidad'] = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : null;
    $_SESSION['idiomas'] = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
    $_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : null;
    $_SESSION['imagen'] = isset($_POST['imagen']) ? $_POST['imagen'] : null;

    echo "<h2>$nombre $apellidos</h2>";
    echo "$email<br>";
    echo "Nivel de estudio: $nivelEstudio<br>";
    echo "Nacionalidad: $nacionalidad<br>";
    echo "Idiomas: ";
    foreach ($idiomas as $idioma) {
        echo $idioma . " ";
    }

    echo "<br>";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenData = file_get_contents($imagenTmp);
        $imagenBase64 = base64_encode($imagenData);

        echo "<img src='data:image/jpeg;base64,$imagenBase64' width='200'>";
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
