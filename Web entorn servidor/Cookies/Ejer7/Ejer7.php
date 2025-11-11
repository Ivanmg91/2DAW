<?php
    $contrasena = 1111;
    $maxIntentos = 4;

    $intentos = isset($_POST['intentos']) ? $_POST['intentos'] : 0;
    $contrasenaUsuario = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
    $mensaje = '';

    if ($contrasenaUsuario !== null) {

        if ($contrasenaUsuario == $contrasena) {

            $mensaje = '<span style="color: green;">La caja fuerte se ha abierto satisfactoriamente</span>';
        
        } else {

            $intentos++;
            if ($intentos >= $maxIntentos) {

                $mensaje = '<span style="color: red;">Has alcanzado el límite de intentos.</span>';
            
            } else {

                $mensaje = '<span style="color: red;">Contraseña incorrecta.';
            
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
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

    <?php if ($intentos < $maxIntentos && $mensaje != "La caja fuerte se ha abierto satisfactoriamente"): ?>
        <form action="Ejer7.php" method="POST">
            <label for="contrasena">Contraseña:</label><br>
            <input type="number" id="contrasena" name="contrasena" required><br><br>
            
            <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">

            <input type="submit" value="Probar">
        </form>
    <?php endif; ?>

    <?php if ($intentos >= $maxIntentos): ?>
        <p><a href="Ejer7.php"><?php echo "Reiniciar intento"; ?></a></p>
    <?php endif; ?>
</body>
</html>
