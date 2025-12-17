<?php
// importar funcines de validacion
require_once '../../valida.php';

// inicializar variables
$errores = [];
$procesado_exito = false;
$accion = $_POST['accion'] ?? null;

$nombre = "";
$perfil = "";
$empleados = [2000, 2100, 3000, 1900, 2000, 2500];

// PROCESAMIENTO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECOGER DATOS
    $nombre = $_POST['nombre'] ?? '';
    $perfil = $_POST['perfil'] ?? '';

    // VALIDACIONES
    // Validar nombre
    if (!validaRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (!validaAlfa($nombre)) {
        $errores[] = "El nombre no puede contener carácteres no alfabetico.";
    }
    // Validar q es requerido
    if (!validaRequerido($perfil)) {
        $errores[] = "El perfil es obligatorio";
    }


    //SI NO HAY ERRORES
    if (count($errores) === 0) {
        $procesado_exito = true;
    }


    // LÓGICA DE DECISIÓN
    if (count($errores) === 0) { // SI TODO ESTA BIEN

        if ($accion === 'Validar') {
            // Si solo queria validar, todo correcot
            $mensaje_exito = "¡Todo correcto! El formulario está listo para enviarse.";
        } elseif ($accion === 'Enviar') {
            // Si quiere enviar, construimos el header y nos vamos a resultados php
            
            $minimo = min($empleados);
            $maximo = max($empleados);
            $media = array_sum($empleados) / count($empleados);

            // Preparamos los datos para la URL
            $datos_a_pasar = [
                'nombre' => $nombre,
                'perfil' => $perfil,
                'minimo' => $minimo,
                'maximo' => $maximo,
                'media' => $media
            ];

            // http_build_query convierte el array en "nombre=pepe&email=...@..."
            $query_string = http_build_query($datos_a_pasar);

            // REDIRECCIÓN
            header("Location: resultados.php?" . $query_string);
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
            <p><strong>Perfil:</strong> <?php echo $email; ?></p>
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
                <p><strong>Perfil:</strong> <?php echo $perfil; ?></p>
            </div>

            <br>
            <p>Todo parece correcto. Puedes volver para enviar los datos definitivamente.</p>
            <a href="javascript:history.back()"><button>Volver</button></a>

        <?php endif; ?>

    <?php endif; ?>

</body>

</html>

<!-- Iván Montiano González -->