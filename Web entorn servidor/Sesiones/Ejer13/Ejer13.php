<?php
session_start();

$_SESSION['nombre'] = $_POST['nombre'] ?? null;
$_SESSION['apellidos'] = $_POST['apellidos'] ?? null;
$_SESSION['nivelEstudio'] = $_POST['nivel-estudio'] ?? null;
$_SESSION['nacionalidad'] = $_POST['nacionalidad'] ?? null;

if ($_SESSION['nacionalidad'] === "Otro" && !empty($_POST['nacionalidad-otra'])) {
    $_SESSION['nacionalidad'] = $_POST['nacionalidad-otra'];
}

$_SESSION['idiomas'] = $_POST['idiomas'] ?? [];
$_SESSION['email'] = $_POST['email'] ?? null;

$nombre = $_SESSION['nombre'];
$apellidos = $_SESSION['apellidos'];
$nivelEstudio = $_SESSION['nivelEstudio'];
$nacionalidad = $_SESSION['nacionalidad'];
$idiomas = $_SESSION['idiomas'];
$email = $_SESSION['email'];

echo "<h2>$nombre $apellidos</h2>";
echo "$email<br>";
echo "Nivel de estudio: $nivelEstudio<br>";
echo "Nacionalidad: $nacionalidad<br>";
echo "Idiomas: ";

foreach ($idiomas as $idioma) {
    echo $idioma . " ";
}

echo "<br><br>";

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenData = file_get_contents($imagenTmp);
    $imagenBase64 = base64_encode($imagenData);

    echo "<img src='data:image/jpeg;base64,$imagenBase64' width='200'>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer11</title>
</head>
<body>
    <p><a href="index.html">Volver</a></p>
</body>
</html>
