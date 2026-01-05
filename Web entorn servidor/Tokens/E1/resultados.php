<?php
session_start();
// Recoger los datos
$nombre = $_SESSION['nombre'];
$perfil = $_SESSION['perfil'];
$minimo = $_SESSION['minimo'];
$maximo = $_SESSION['maximo'];
$media  = $_SESSION['media'];

// Seguridad
// Si alguien intenta entrar directamente escribiendo "resultados.php" sin datos,
if (!$nombre || !$perfil) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de usuario</title>
</head>
<body>

    <h1>Resultado: <?php echo htmlspecialchars($perfil); ?></h1>
    
    <p>Bienvenido al sistema, <strong><?php echo htmlspecialchars($nombre); ?></strong>.</p>
    
    <hr>
    
    <p><em>
        <?php 
            switch ($perfil) {
                case 'Gerente': // El gerente ve todos los datos
                    echo "<p>Salario Mínimo: <strong>$minimo €</strong></p>";
                    echo "<p>Salario Máximo: <strong>$maximo €</strong></p>";
                    echo "<p>Media de salario: <strong>$media €</strong></p>";
                    break;
                case 'Sindicalista': // El sindicalista ve solo la media
                    echo "<p>Media de salario: <strong>$media €</strong></p>";
                    break;
                case 'Responsable': //Solo minimo y maxiomo
                    echo "<p>Salario Mínimo: <strong>$minimo €</strong></p>";
                    echo "<p>Salario Máximo: <strong>$maximo €</strong></p>";
                    break;
                default:
                    echo "<p>No se encuentra perfil</p>";
                    break;
            }
        ?>
    </em></p>

    <br><br>

    <a href="logout.php?token=<?php echo $_SESSION['token']; ?>"><button>Cerrar Sesión</button></a>

</body>
</html>

<!-- Iván Montiano González -->