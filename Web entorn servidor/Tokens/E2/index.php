<?php 
session_start();

// generación del token
if (empty($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
}

// si ya está logueado, lo mandamos dentro
if (isset($_SESSION['usuario'])) {
    header("Location: resultados.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Roles Académicos</title>
</head>
<body>
    <h2>Formulario de Identificación</h2>

    <form action="procesar.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        <label>Nombre y Apellido:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Asignatura</label><br>
        <input type="text" name="asignatura" required><br><br>

        <label>Grupo</label><br>
        <input type="text" name="grupo" required><br><br>

        <input type="radio" name="edad" value="menor" required> Menor de edad
        <input type="radio" name="edad" value="mayor"> Mayor de edad

        <br><br>

        <input type="radio" name="cargo" value="si" required> Con cargo
        <input type="radio" name="cargo" value="no"> Sin cargo

        <br><br>

        <input type="submit" name="accion" value="Validar">
        <input type="submit" name="accion" value="Enviar">
        <button type="reset">Limpiar</button>

    </form>

    <hr>

    <form action="index.php" method="POST">
         <p>Zona de pruebas:</p>
         <input type="submit" name="cambiar_sid" value="Cambiar SID (Regenerar Token)">
    </form>

    <?php
    // si se pulsa el botón regeneramos el token despues del formulario. asi el formulario tiene el token viejo y la sesión el nuevo.
    if (isset($_POST['cambiar_sid'])) {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        
        echo "<br><div style='color:red; border:1px solid red; padding:10px;'>";
        echo "<strong>TOKEN REGENERADO</strong><br>";
        echo "El formulario de arriba ahora tiene un token caducado.<br>";
        echo "</div>";
    }
    ?>

</body>
</html>
