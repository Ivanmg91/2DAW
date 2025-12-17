<?php
// importar funcines de validacion
require_once '../../valida.php';

session_start();

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


    //SI NO HAY ERRORES
    if (count($errores) === 0) {
        $procesado_exito = true;
    }


    // LOGICA
    if (count($errores) === 0) { // SI TODO ESTA BIEN

        if ($accion === 'Validar') {
            // Si solo queria validar, todo correcot
            $mensaje_exito = "¡Todo correcto! El formulario está listo para enviarse.";
        } elseif ($accion === 'Enviar') {
            // Si quiere enviar, construimos el header y nos vamos a resultados php
            
            $_SESSION['usuario'] = [
                'nombre' => $nombre,
                'asignatura' => $asignatura,
                'grupo' => $grupo,
                'edad' => $edad,
                'cargo' => $cargo,
                'perfil' => $perfil
            ];

            // REDIRECCIÓN
            header("Location: resultados.php" );
            exit(); // Detener script al final
        }
    }
} else {
    // Si intentan entrar directamente a procesar.php sin formulario
    header("Location: index.html");
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

    <!-- lo q se meustra si el array de errores tiene alguno -->
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

        <div>
            <h4>Datos introducidos (intento fallido):</h4>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
                <p><strong>Asignatura:</strong> <?php echo $asignatura; ?></p>
                <p><strong>Grupo:</strong> <?php echo $grupo; ?></p>
                <p><strong>Mayor de edad:</strong> <?php if ($edad == "mayor") {
                    echo "Si";
                } else {
                    echo "No";
                } ?></p>
                <p><strong>Cargo:</strong> <?php echo $cargo; ?></p>
        </div>

        <br>
        <a href="javascript:history.back()"><button>Volver al formulario</button></a>


    <?php elseif ($procesado_exito): ?>

        <?php if ($accion === 'Validar'): ?>

            <div>
                <p>Formulario validado correctamente</p>
            </div>

            <div>
                <h3>Resumen de datos:</h3>
                <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
                <p><strong>Asignatura:</strong> <?php echo $asignatura; ?></p>
                <p><strong>Grupo:</strong> <?php echo $grupo; ?></p>
                <p><strong>Mayor de edad:</strong> <?php if ($edad == "mayor") {
                    echo "Si";
                } else {
                    echo "No";
                } ?></p>
                <p><strong>Cargo:</strong> <?php echo $cargo; ?></p>
            </div>

            <br>
            <p>Todo parece correcto. Puedes volver para enviar los datos definitivamente.</p>
            <a href="javascript:history.back()"><button>Volver</button></a>

        <?php endif; ?>

    <?php endif; ?>

</body>

</html>

<!-- Iván Montiano González -->