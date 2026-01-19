<?php
session_start();
require_once '../../valida.php';

//verificación token
if (!isset($_POST['token'])) {
    echo "<h3 style='color:red'>Error: No se ha encontrado el token de seguridad.</h3>";
    echo "<a href='index.php'>Volver</a>";
    exit(); 
} else {
    if (hash_equals($_SESSION['token'], $_POST['token']) === false) {
        echo "<h3 style='color:red'>El token no coincide</h3>";
        echo "<a href='index.php'>Volver</a>";
        exit();
    }
}

// inicializar variables
$errores = [];
$procesado_exito = false;
$accion = $_POST['accion'] ?? null;

$nombre = "";
$asignatura = "";
$grupo = "";
$edad = "";
$cargo = "";
$perfil = "";

// PROCESAMIENTO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECOGER DATOS
    $nombre = $_POST['nombre'] ?? '';
    $asignatura = $_POST['asignatura'] ?? '';
    $grupo = $_POST['grupo'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $cargo = $_POST['cargo'] ?? '';

    // VALIDACIONES
    if (!validaRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (!validaRequerido($asignatura)) {
        $errores[] = "La asignatura es obligatoria.";
    }
    if (!validaRequerido($grupo)) {
        $errores[] = "El grupo es obligatorio.";
    }
    if (!validaRequerido($cargo)) {
        $errores[] = "El cargo es obligatorio.";
    }
    if (!validaNombreApellidosSimple($nombre)) {
        $errores[] = "El formato de nombre es xxxx xxxx xxxx.";
    }

    if ($edad === 'menor') {
        // mayores
        if ($cargo === 'si') {
            $perfil = "Delegado";
        } else {
            $perfil = "Estudiante";
        }
    } else {
        // menores
        if ($cargo === 'si') {
            $perfil = "Director";
        } else {
            $perfil = "Profesor";
        }
    }

    // SI NO HAY ERRORES
    if (count($errores) === 0) {
        $procesado_exito = true;
    }

    // LOGICA
    if (count($errores) === 0) { 

        if ($accion === 'Validar') {
            $mensaje_exito = "¡Todo correcto! El formulario está listo para enviarse.";
        } elseif ($accion === 'Enviar') {
            
            $_SESSION['usuario'] = [
                'nombre' => $nombre,
                'asignatura' => $asignatura,
                'grupo' => $grupo,
                'edad' => $edad,
                'cargo' => $cargo,
                'perfil' => $perfil
            ];

            header("Location: resultados.php" );
            exit(); 
        }
    }
} else {
    // si entran directo
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado del Formulario</title>
</head>
<body>

    <?php if (count($errores) > 0): ?>

        <div>
            <h3>ERRORES:</h3>
            <ul>
                <?php foreach ($errores as $error) { ?>
                    <li><?php echo $error; ?></li>
                <?php } ?>
            </ul>
            <p>Por favor, vuelve atrás y corrige los campos.</p>
        </div>
        <br>
        <a href="javascript:history.back()"><button>Volver al formulario</button></a>

    <?php elseif ($procesado_exito && $accion === 'Validar'): ?>

        <div>
            <p>Formulario validado correctamente</p>
            <h3>Resumen de datos:</h3>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Perfil detectado:</strong> <?php echo $perfil; ?></p>
        </div>
        <br>
        <a href="javascript:history.back()"><button>Volver</button></a>

    <?php endif; ?>

</body>
</html>
