<?php 
session_start();

// GENERACIÓN DEL TOKEN
if (empty($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
}

// Redirección si ya habia una session
if (isset($_SESSION["nombre"]) && isset($_SESSION["perfil"])) {
    header("Location: resultados.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 11 - Estricto PDF</title>
</head>
<body>
    <h2>Formulario de Registro</h2>

    <form action="procesar.php" method="POST">
        
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Perfil</label>
        <select name="perfil" required>
            <option value="Gerente">Gerente</option>
            <option value="Sindicalista">Sindicalista</option>
            <option value="Responsable">Responsable</option>
        </select>

        <br><br>
        <input type="submit" name="accion" value="Validar">
        <input type="submit" name="accion" value="Enviar">
        <button type="reset">Limpiar</button>
    </form>

    <hr>

    <form action="index.php" method="POST">
         <p>Prueba:</p>
         <input type="submit" name="cambiar_sid" value="Cambiar SID">
    </form>

</body>
</html>

<?php

if (isset($_POST['cambiar_sid'])) {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
}
?>

<!-- Iván Montiano González -->