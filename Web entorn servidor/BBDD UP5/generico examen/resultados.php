<!-- RESULTADOS -->

<?php
    session_start();
    require_once 'Alumno.php'; // Vital para que funcione unserialize

    // Si no hay alumno en sesión, fuera
    if (!isset($_SESSION['alumno'])) {
        header("Location: index.php");
        exit;
    }

    // Recuperamos el objeto
    $alumno = unserialize($_SESSION['alumno']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1 style="color:blue">Ficha del Alumno</h1>
    
    <?= $alumno ?>

    <p><strong>Foto:</strong></p>
    <?php 
        $ruta = $alumno->getRutaFoto(); 
    ?>

    <?php if ($ruta && file_exists($ruta)): ?>
        <img src="<?= htmlspecialchars($ruta) ?>" style="max-width:200px; border:1px solid #ddd; padding:5px;">
    <?php else: ?>
        <p style="color:gray;">No se ha subido ninguna foto.</p>
    <?php endif; ?>

    <br><br>
    <a href="form.php">Volver al formulario</a>
</body>
</html>