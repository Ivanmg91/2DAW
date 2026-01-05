<?php
    session_start();
    // Si no hay sesion fuera
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    // sesion
    $datos_usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de usuario</title>
</head>
<body>

    <h1>Resultado: <?php echo $datos_usuario['perfil']; ?></h1>

    <p>Bienvenido al sistema, <strong><?php echo $datos_usuario['nombre']; ?></strong>.</p>

    <hr>

    <p><em>
        Asignatura: <?php echo $datos_usuario['asignatura'] ?><br>
        Grupo: <?php echo $datos_usuario['grupo'] ?><br>
    </em></p>

    <br><br>

    <a href="logout.php?token=<?php echo $_SESSION['token']; ?>">
        <button>Cerrar Sesión</button>
    </a>

</body>
</html>