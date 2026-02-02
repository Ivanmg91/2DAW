<!-- CONTROLADOR -->

<?php 
// controller.php
session_start();

require_once 'Alumno.php'; 
require_once 'database.php';

// 1. Gestión del Token CSRF
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(24));
}

// 2. Inicialización de Variables (Sticky Form)
// Inicializamos todo vacío por defecto para que no de error la primera vez
$usuario    = $_POST['usuario'] ?? '';
$nombre     = $_POST['nombre'] ?? '';
$email      = $_POST['email'] ?? '';
$password   = $_POST['password'] ?? '';
$direccion  = $_POST['direccion'] ?? '';
$cp         = $_POST['cp'] ?? '';
$accion     = $_POST['accion'] ?? '';
$registrado = $_POST['registrado'] ?? '';
$tipo       = $_POST['tipo'] ?? '';
$estado     = $_POST['estado'] ?? ''; // Faltaba esta variable en tu código original

$errores = [];

// 3. Lógica de Checkboxes (Preferencia de servicios)
$servicios = $_POST['servicios'] ?? ($_SESSION['servicios'] ?? []);

// Creamos variables booleanas para marcar los checkboxes en el HTML
$checkboxZonaComercial      = in_array('ZonaComercial', $servicios);
$checkboxPiscina            = in_array('Piscina', $servicios);
$checkboxParking            = in_array('Parking', $servicios);
$checkboxParqueInfantil     = in_array('ParqueInfantil', $servicios);
$checkboxTransportePublico  = in_array('TransportePublico', $servicios);
$checkboxAmueblado          = in_array('Amueblado', $servicios);

// 4. Lógica de Validación
if ($accion === "Validar" || $accion === "Enviar") {
    
    // Validar Token
    if (!isset($_POST['token']) || !hash_equals($_SESSION['token'], $_POST['token'])) {
        $errores[] = "Error de seguridad: token inválido.";
    }

    // Validar Campos de Texto
    if ($nombre === '') {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!ctype_alpha(str_replace(' ', '', $nombre))) { // Permitimos espacios
        $errores[] = "El nombre solo puede contener letras.";
    }

    if ($usuario === '') {
        $errores[] = "El usuario es obligatorio."; // Corregido mensaje
    } elseif (!ctype_alpha($usuario)) {
        $errores[] = "El usuario solo puede contener letras.";
    }

    if ($password === '' || strlen($password) < 6 ) {
        $errores[] = "La contraseña debe tener mínimo 6 caracteres.";
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Introduce un email válido.";
    }

    if ($direccion === '') {
        $errores[] = "Pon una dirección de estudios.";
    }

    // Validar al menos un checkbox
    if (empty($servicios)) {
        $errores[] = "Selecciona al menos un extra.";
    }

    // 5. Validación específica para ENVIAR (Subida de foto)
    if ($accion === "Enviar") {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== 0) {
            $errores[] = "Debes adjuntar una foto.";
        } else {
            $archivo = $_FILES['foto'];
            $ext = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            $permitidas = ["jpg","jpeg","gif","png"];

            if (!in_array($ext, $permitidas)) {
                $errores[] = "Formato de imagen no permitido.";
            }

            if ($archivo['size'] > 50000) {
                $errores[] = "La imagen no puede superar los 50 KB.";
            }
        }

    }
}

// 5. PROCESAMIENTO FINAL (Solo si es Enviar y NO hay errores)
if ($accion === "Enviar" && empty($errores)) {
    
    // PASO 1: Subir la imagen primero para tener la ruta
    $dir = "img";
    if (!is_dir($dir)) mkdir($dir);
    
    // Necesitamos la extensión de nuevo o asegurar que viene de arriba
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $nombre_unico = uniqid($usuario . "_") . "." . $ext;
    $ruta = "$dir/$nombre_unico";
    
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta)) {
        
        // PASO 2: Crear el Objeto Alumno (Ahora sí tenemos la $ruta y los datos validados)
        $alumno = new Alumno(
            $usuario, $nombre, $password, $email, 
            $direccion, $cp, $registrado, $estado, 
            $tipo, $servicios, $ruta
        );

        // PASO 3: Insertar en Base de Datos (Ahora $alumno EXISTE)
        try {
            $sql = "INSERT INTO alumno (usuario, nombre, password, email, direccion, cp, registrado, estado, tipo, servicios, rutafoto)
                    VALUES (:usuario, :nombre, :password, :email, :direccion, :cp, :registrado, :estado, :tipo, :servicios, :rutafoto)";

            $stmt = $pdo->prepare($sql);
            
            // Usamos el objeto para obtener los datos
            $stmt->execute([
                ':usuario'    => $alumno->getUsuario(),
                ':nombre'     => $alumno->getNombre(),
                ':password'   => password_hash($alumno->getPassword(), PASSWORD_DEFAULT),
                ':email'      => $alumno->getEmail(),
                ':direccion'  => $alumno->getDireccion(),
                ':cp'         => $alumno->getCP(),
                ':registrado' => $alumno->getRegistrado(),
                ':estado'     => $alumno->getEstado(), // Asegúrate de tener este getter en Alumno.php
                ':tipo'       => $alumno->getTipo(),
                ':servicios'  => $alumno->getServiciosTexto(), // Usamos el helper que convierte a String
                ':rutafoto'   => $alumno->getRutaFoto()
            ]);

            // PASO 4: Guardar en sesión y Redirigir
            $_SESSION['alumno'] = serialize($alumno);
            $_SESSION['archivo'] = $ruta; // Por compatibilidad si lo usas suelto

            header("Location: resultados.php");
            exit;

        } catch (PDOException $e) {
            // Si falla la BD, borramos la foto subida para no dejar basura
            unlink($ruta); 

            if ($e->getCode() == 23000) {
                $errores[] = "El usuario ya existe.";
            } else {
                $errores[] = "Error BD: " . $e->getMessage();
            }
        }

    } else {
        $errores[] = "Error al mover el archivo al servidor.";
    }
}
?>