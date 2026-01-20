<?php 
session_start();

//Token
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(24));
}

//Variables

$usuario = $_POST['usuario'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$cp = $_POST['cp'] ?? '';
$accion = $_POST['accion'] ?? '';
$errores = [] ;
$registrado = $_POST['registrado'] ??'';
$tipo = $_POST['tipo'] ??'';

//Preferencia de servicios
$servicios = $_POST['servicios'] ?? ($_SESSION['servicios'] ?? []);
$checboxZonaComercial = in_array('ZonaComercial', $servicios) ? true : false ;
$checkboxPiscina = in_array('Piscina', $servicios) ? true : false ;
$checkboxParking = in_array('Parking', $servicios) ? true : false;
$checkboxParqueInfantil = in_array('ParqueInfantil', $servicios) ? true : false;
$checkboxTransportePublico = in_array('TransportePublico', $servicios) ? true : false ;
$checkboxAmueblado = in_array('Amueblado', $servicios) ? true : false ;



// Validación
if ($accion === "Validar" || $accion === "Enviar") {
     if (!isset($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])) {
        $errores[] = "Error de seguridad: token inválido.";
    }
    if ($nombre === '') {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!ctype_alpha($nombre)) {
        $errores[] = "El nombre solo puede contener letras del abecedario y espacios.";
    }
     if ($usuario === '') {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!ctype_alpha($usuario)) {
        $errores[] = "El usuario solo puede contener letras del abecedario y espacios.";
    }
    if ($password === '' || strlen($password) < 6 ) 
        $errores[] = "La contraseña debe tener mínimo 6 caracteres.";

      if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $errores[] = "Introduce un email válido.";

    if ($direccion === '')
        $errores[] = "Pon una dirección de estudios.";
    if (!($checboxZonaComercial || $checkboxAmueblado || $checkboxPiscina || $checkboxParking || $checkboxParqueInfantil || $checkboxTransportePublico)) {
        $errores[] = "Selecciona al menos un extra.";
    }

    if ($accion === "Enviar") {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
            $errores[] = "Debes adjuntar una foto.";
        } else {
            $archivo = $_FILES['foto'];
            $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            $tamaño = $archivo['size'];
            $permitidas = ["jpg","jpeg","gif","png"];

            if (!in_array($ext, $permitidas))
                $errores[] = "Formato de imagen no permitido (jpg, gif, png).";

            if ($tamaño > 50000)
                $errores[] = "La imagen no puede superar los 50 KB.";
        }
    }
}
//Generar el token si el usuario ya existe
//if ($registrado === 'Si'){

//}

//Guardar los datos por la sesion si no hay errores
if ($accion === "Enviar" && empty($errores)) {
    $anadidos = [];
    if ($checboxZonaComercial) $anadidos[] = "ZonaComercial";
    if ($checkboxAmueblado) $anadidos[] = "Amueblado";
    if ($checkboxPiscina) $anadidos[] = "Piscina";
    if ($checkboxParking) $anadidos[] = "Parking";
    if ($checkboxParqueInfantil) $anadidos[] = "ParqueInfantil";
    if ($checkboxTransportePublico) $anadidos[] = "TransportePublico";


    $_SESSION['nombre'] = $nombre;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['direccion'] = $direccion;
    $_SESSION['cp'] = $cp;
    $_SESSION['email'] = $email;
    $_SESSION['anadidos'] = $anadidos;
    $_SESSION['tipo'] = $tipo;
    $_SESSION['registrado'] = $registrado;

    $dir = "img";
    if (!is_dir($dir)) mkdir($dir);
    $nombre_unico = uniqid($usuario)."_."."AAAMMDD_HHMMSS";
    $ruta = "$dir/$nombre_unico";
    if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
        $_SESSION['archivo'] = $ruta;
        header("Location: alumno_ok.php");
        exit;
    } else {
        $errores[] = "Error al guardar la imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<h1>Formulario SENIATOURS</h1>

<?php if (!empty($errores)): ?>
    <ul style="color:red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($accion === "Validar"): ?>
    <h3 style="color:green;">Sin errores</h3>
<?php endif; ?>
<form method="post" enctype="multipart/form-data" action="alumno.php">

    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <p><strong>Usuario:</strong></p>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario) ?>"><br><br>

    <p><strong>Nombre:</strong></p>
    <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>"><br><br>

    <p><strong>Contraseña:</strong></p>
    <input type="password" name="password" value="<?= htmlspecialchars($password) ?>"><br><br>


    <p><strong>Email:</strong></p>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

    <p><strong>Direccion:</strong></p>
    <input type="text" name="direccion" value="<?= htmlspecialchars($direccion) ?>"><br><br>

    <p><strong>CP:</strong></p>
    <input type="number" name="cp" value="<?= htmlspecialchars($cp) ?>"><br><br>

    <p><strong>¿Estás ya registrado?:</strong></p>
    <label><input type="radio" name="registrado" value="Si" <?= $registrado === "Si" ? "checked" : "" ?>> Si</label>
    <label><input type="radio" name="registrado" value="No" <?= $registrado === "No" ? "checked" : "" ?>> No</label>
    <br><br>

    <p><strong>Tipo de instancia:</strong></p>
    <select name="estado">
        <option value="">--Selecciona--</option>
        <option value="Chalet" <?= $estado === "Chalet" ? "selected" : "" ?>>Chalet</option>
        <option value="Piso" <?= $estado === "Piso" ? "selected" : "" ?>>Piso</option>
        <option value="Apartamento" <?= $estado === "Apartamento" ? "selected" : "" ?>>Apartamento</option>
        <option value="Cabanya" <?= $estado === "Cabanya" ? "selected" : "" ?>>Cabanya</option>
        <option value="CasaRural" <?= $estado === "CasaRural" ? "selected" : "" ?>>CasaRural</option>
    </select>

    <br><br>
    <p><strong>Tipo de alquiler:</strong></p>
    <label><input type="radio" name="tipo" value="Dias" <?= $tipo === "Dias" ? "checked" : "" ?>> Dias</label>
    <label><input type="radio" name="tipo" value="Semanas" <?= $tipo === "Semanas" ? "checked" : "" ?>> Semanas</label>
    <label><input type="radio" name="tipo" value="Meses" <?= $tipo === "Meses" ? "checked" : "" ?>> Meses</label>
    <br><br>

    <p><strong>Actividades Extra:</strong></p>
    <label><input type="checkbox" name="servicios[]" value="ZonaComercial" <?= $checkboxZonaComercial ? "checked" : "" ?>> Cine</label><br>
    <label><input type="checkbox" name="servicios[]" value="Piscina" <?= $checkboxPiscina ? "checked" : "" ?>> Deporte</label><br>
    <label><input type="checkbox" name="servicios[]" value="Parking" <?= $checkboxParking ? "checked" : "" ?>> Parking</label><br>
    <label><input type="checkbox" name="servicios[]" value="ParqueInfantil" <?= $checkboxParqueInfantil ? "checked" : "" ?>> Parque Infantil</label><br>
    <label><input type="checkbox" name="servicios[]" value="TransportePublico" <?= $checkboxTransportePublico ? "checked" : "" ?>> Transporte Público</label><br>
    <label><input type="checkbox" name="servicios[]" value="Amueblado" <?= $checkboxAmueblado ? "checked" : "" ?>> Amueblado</label><br>
    <br><br>
    
    <p><strong>Foto:</strong></p>
    <input type="file" name="foto"><br><br>
    
    <input type="reset" value="Borrar">
    <input type="submit" name="accion" value="Validar">
    <input type="submit" name="accion" value="Enviar">

</form>
</body>
</html>
