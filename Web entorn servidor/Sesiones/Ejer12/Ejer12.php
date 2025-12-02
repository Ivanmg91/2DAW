<?php
    $_SESSION['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $_SESSION['apellidos'] = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $_SESSION['edad'] = isset($_POST['edad']) ? $_POST['edad'] : null;
    $_SESSION['peso'] = isset($_POST['peso']) ? $_POST['peso'] : null;
    $_SESSION['sexo'] = isset($_POST['sexo']) ? $_POST['sexo'] : null;

    $seleccion_radio = $_POST['estado-civil'] ?? null;
    $texto_otro = $_POST['estado-civil-otro'] ?? null;
    if ($seleccion_radio === 'Otro' && !empty($texto_otro)) {
        $_SESSION['estadoCivil'] = $texto_otro;
    } else {
        $_SESSION['estadoCivil'] = $seleccion_radio;
    }

    $_SESSION['aficiones'] = isset($_POST['aficiones']) ? $_POST['aficiones'] : [];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
</head>
<body>

    <h2><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></h2>
    
    <p>
        <strong>Edad:</strong> <?php echo $_SESSION['edad']; ?><br>
        <strong>Peso:</strong> <?php echo $_SESSION['peso']; ?><br>
        <strong>Sexo:</strong> <?php echo $_SESSION['sexo']; ?><br>
        
        <strong>Estado Civil:</strong> <?php echo $_SESSION['estadoCivil']; ?>
    </p>

    <p><strong>Aficiones:</strong>
    <?php
        if (!empty($_SESSION['aficiones'])) {
            foreach ($_SESSION['aficiones'] as $aficion) {
                echo $aficion . " ";
            }
        } else {
            echo "Ninguna";
        }
    ?>
    </p>

    <p><a href="index.html">Volver</a></p>

</body>
</html>