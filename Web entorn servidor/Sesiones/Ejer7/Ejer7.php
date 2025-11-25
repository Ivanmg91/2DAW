<?php
    session_start();

    // al pulsar el reinciar se añade borrar al header y con esto resetea los intentos
    if (isset($_GET['borrar'])) {
        session_destroy();
        header("Location: Ejer7.php");
        exit;
    }

    $contrasena = 1111;
    $maxIntentos = 4;

    $intentos = $_SESSION['intentos'] ?? 0;
    $contraseñasIntroducidas = $_SESSION['contraseñasIntroducidas'] ?? [];

    $contrasenaUsuario = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
    $mensaje = '';

    if ($contrasenaUsuario !== null) {

        if ($contrasenaUsuario == $contrasena) {
            $intentos = 0;
            $_SESSION['intentos'] = 0;
            $mensaje = '<span style="color: green;">La caja fuerte se ha abierto satisfactoriamente</span>';
            
        } else {
            $intentos++;
            
            $contraseñasIntroducidas[] = $contrasenaUsuario;

            $_SESSION['intentos'] = $intentos;
            $_SESSION['contraseñasIntroducidas'] = $contraseñasIntroducidas;

            if ($intentos >= $maxIntentos) {
                $mensaje = '<span style="color: red;">Has alcanzado el límite de intentos.</span>';
            } else {
                $mensaje = '<span style="color: red;">Contraseña incorrecta.</span>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja Fuerte</title>
</head>
<body>
    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <p>Intentos restantes: <?php echo $maxIntentos - $intentos; ?> / <?php echo $maxIntentos; ?></p>

    <?php if (!empty($contraseñasIntroducidas)): ?>
        <h3>Contraseñas ya introducidas:</h3>
        <ul>
            <?php foreach ($contraseñasIntroducidas as $clave): ?>
                <li><?php echo htmlspecialchars($clave); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($intentos < $maxIntentos && $mensaje != "La caja fuerte se ha abierto satisfactoriamente"): ?>
        <form action="Ejer7.php" method="POST">
            <label for="contrasena">Contraseña:</label><br>
            <input type="number" id="contrasena" name="contrasena" required><br><br>
            

            <input type="submit" value="Probar">
        </form>
    <?php endif; ?>

    <?php if ($intentos >= $maxIntentos): ?>
        <p><a href="Ejer7.php?borrar=1"><?php echo "Reiniciar intento"; ?></a></p>
    <?php endif; ?>
</body>
</html>