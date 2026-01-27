<?php
    $nombre = $_GET['nombre'] ?? 'Desconocido';
    $estudios = $_GET['estudios'] ?? 'No especificado';
    $nacionalidad = $_GET['nacionalidad'] ?? 'No especificada';
    $email = $_GET['email'] ?? 'No especificado';
    $idiomas = $_GET['idiomas'] ?? 'Ninguno';
    $ruta_imagen = $_GET['ruta_imagen'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesado</title>
</head>
<body>

    <h1>Procesado</h1>
    <p>Sus datos han sido registrados correctamente en el sistema.</p>

    <div class="ficha">
        <h3>Ficha del Usuario</h3>
        <ul>
            <li><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($nombre); ?></li>
            <li><strong>Estudios:</strong> <?php echo htmlspecialchars($estudios); ?></li>
            <li><strong>Nacionalidad:</strong> <?php echo htmlspecialchars($nacionalidad); ?></li>
            <li><strong>Idiomas:</strong> <?php echo htmlspecialchars($idiomas); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
        </ul>

        <?php if($ruta_imagen): ?>
            <div>
                <strong>Foto de perfil:</strong><br>
                <img src="<?php echo htmlspecialchars($ruta_imagen); ?>" alt="Foto Usuario">
            </div>
        <?php else: ?>
            <p><em>No se ha podido cargar la imagen.</em></p>
        <?php endif; ?>
    </div>

    <div class="firma">
        <p>Realizado por: <strong>Iván Montiano González</strong> | Grupo: <strong>2 DAW</strong></p>
        <a href="procesar.php"><button>Volver</button></a>
    </div>

</body>
</html>