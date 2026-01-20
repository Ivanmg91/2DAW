<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION["nombre"];
$usuario = $_SESSION["usuario"];
$direccion = $_SESSION["direccion"];
$cp = $_SESSION["cp"];
$email = $_SESSION["email"];
$anadidos = $_SESSION["anadidos"];
$archivo = $_SESSION['archivo'] ?? '';
$tipo = $_SESSION['tipo'] ??'';
$registrado = $_SESSION['registrado'] ??'';



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    
</head>
<body>
    <h1 style="color:blue">Cesar Rodriguez</h1>
<h2>Este es el formulario de resultados</h2>

<p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
<p><strong>Usuario:</strong> <?= htmlspecialchars($usuario) ?></p>
<p><strong>Direccion:</strong> <?= htmlspecialchars($direccion) ?></p>
<p><strong>Codigo Postal:</strong> <?= htmlspecialchars($cp) ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
<p><strong>Tipo:</strong> <?= htmlspecialchars($tipo) ?></p>
<p><strong>Registrado:</strong> <?= htmlspecialchars($registrado) ?></p>



<p><strong>Añadidos:</strong></p>
<ul>
    <?php foreach ($anadidos as $i): ?>
        <li><?= htmlspecialchars($i) ?></li>
    <?php endforeach; ?>
</ul>

<p><strong>Foto:</strong></p>
<?php if ($archivo && file_exists($archivo)): ?>
    <img src="<?= htmlspecialchars($archivo) ?>" style="max-width:200px;"><br>
    <p><?= htmlspecialchars($archivo) ?></p>
<?php else: ?>
    <p>No hay imagen.</p>
<?php endif; ?>
<a href="alumno.php">Volver</a>
</body>
</html>