<?php
// incluir le fichero de validación
require_once 'valida.php';

// inicializar variables
$errores = [];
$datos = []; // Creo q no sirve
$ruta_imagen = "";
$procesado_exito = false;
$accion = $_POST['accion'] ?? null;

// verificar q llegue por post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // RECOGER DATOS
    $nombre = $_POST['nombre_completo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $estudios = $_POST['estudios'] ?? '';
    
    $nac_radio = $_POST['nacionalidad'] ?? '';
    $nac_texto = $_POST['nacionalidad_texto'] ?? '';
    
    if ($nac_radio === 'otra') {
        $nacionalidad = $nac_texto;
    } else {
        $nacionalidad = "Española";
    }

    $idiomas = $_POST['idiomas'] ?? [];
    $email = $_POST['email'] ?? '';


    // VALIDACIONES
    // Validar nombre
    if (!validaRequerido($nombre)) {
        $errores[] = "El nombre completo es obligatorio.";
    }
    // Validar contraseña
    if (!validaContrasena($contrasena)) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }
    // Validar q llegue algun radiobutton
    if (!validaRequerido($estudios)) {
        $errores[] = "Debes seleccionar un nivel de estudios.";
    }
    // Si marcas nacionalidad otra y dejas el texto vacio
    if ($nac_radio === 'otra' && !validaRequerido($nac_texto)) {
        $errores[] = "Si seleccionas 'Otra' nacionalidad, debes especificar cuál.";
    }
    // validar al menos 1 idioma
    if (empty($idiomas)) {
        $errores[] = "Debes seleccionar al menos un idioma.";
    }
    // validar email
    if (!validaEmail($email)) {
        $errores[] = "El formato del email no es válido.";
    }
    // SUBIDA DE IMAGEN
    $checkImagen = validarYGuardarImagen($_FILES['imagen']);

    if ($checkImagen['correcto'] === false) {
        $errores[] = $checkImagen['mensaje'];
    } else {
        // Si la imagen está bien, guardar la ruta para mostrarla
        $ruta_imagen = $checkImagen['ruta'];
    }
    

    //SI NO HAY ERRORES
    if (count($errores) === 0) {
        $procesado_exito = true;
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
                <?php foreach($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <p>Por favor, vuelve atrás y corrige los campos.</p>
        </div>

        <div>
            <h4>Datos introducidos (intento fallido):</h4>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
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
                <p><strong>Contraseña:</strong> <?php echo $contrasena; ?></p>
                <p><strong>Estudios:</strong> <?php echo $estudios; ?></p>
                <p><strong>Nacionalidad:</strong> <?php echo $nacionalidad; ?></p>
                <p><strong>Idiomas:</strong> 
                    <?php echo implode(", ", $idiomas); ?>
                </p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                
                <p><strong>Foto subida:</strong></p>
                <?php if($ruta_imagen): ?>
                    <img src="<?php echo $ruta_imagen; ?>" alt="Foto usuario" class="foto-subida">
                    <p><small>Ruta: <?php echo $ruta_imagen; ?></small></p>
                <?php endif; ?>
            </div>

            <br>
            <p>Todo parece correcto. Puedes volver para enviar los datos definitivamente.</p>
            <a href="javascript:history.back()"><button>Volver</button></a>


        <?php elseif ($accion === 'Enviar'): ?>

            <h1>¡Procesado con Éxito!</h1>
            
            <p>Sus datos han sido registrados en el sistema.</p>
            
            <hr>
            
            <h3>Ficha del Usuario</h3>
            <ul>
                <li><strong>Nombre Completo:</strong> <?php echo $nombre; ?></li>
                <li><strong>Estudios:</strong> <?php echo $estudios; ?></li>
                <li><strong>Nacionalidad:</strong> <?php echo $nacionalidad; ?></li>
                <li><strong>Idiomas:</strong> <?php echo implode(", ", $idiomas); ?></li>
                <li><strong>Email:</strong> <?php echo $email; ?></li>
            </ul>

            <div>
                <strong>Foto de perfil:</strong><br>
                <?php if($ruta_imagen): ?>
                    <img src="<?php echo $ruta_imagen; ?>" alt="Foto final">
                <?php endif; ?>
            </div>

            <div class="firma">
                <p>Realizado por: <strong>Iván Montiano González</strong> | Grupo: <strong>2 DAW</strong></p>
                <a href="index.html"><button>Volver al inicio</button></a>
            </div>

        <?php endif; ?>

    <?php endif; ?>

</body>
</html>