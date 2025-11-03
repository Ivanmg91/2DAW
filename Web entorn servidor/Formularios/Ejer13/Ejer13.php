<?php
function validar_cadena($nombre, $patron, $cadena) {
    if (preg_match($patron, $cadena)) {
        return "Cadena válida para $nombre: $cadena";
    } else {
        return "Cadena no válida para $nombre: $cadena";
    }
}


$codigo_postal = $_POST['codigo_postal'];
$nif = $_POST['nif'];
$fecha = $_POST['fecha'];
$texto = $_POST['texto'];
$numeros = $_POST['numeros'];
$email = $_POST['email'];
$url = $_POST['url'];
$contraseña = $_POST['contraseña'];
$ipv4 = $_POST['ipv4'];
$mac = $_POST['mac'];


$patron_codigo_postal = '/^(03|12|46)\d{3}$/';
$patron_nif = '/^\d{8}[A-Z]$/';
$patron_fecha = '/^\d{2}[-\/]\d{2}[-\/]\d{4}$/';
$patron_texto = '/^[a-zA-Z\s]+$/';
$patron_numeros = '/^\d+$/';
$patron_email = '/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/';
$patron_url = '/^https?:\/\/[a-zA-Z0-9\.\/-]+\?[\d]+$/';
$patron_contraseña = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';
$patron_ipv4 = '/^(\d{1,3}\.){3}\d{1,3}$/';
$patron_mac = '/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/';

$validez_codigo_postal = validar_cadena("Código postal", $patron_codigo_postal, $codigo_postal);
$validez_nif = validar_cadena("NIF", $patron_nif, $nif);
$validez_fecha = validar_cadena("Fecha", $patron_fecha, $fecha);
$validez_texto = validar_cadena("Texto", $patron_texto, $texto);
$validez_numeros = validar_cadena("Solo números", $patron_numeros, $numeros);
$validez_email = validar_cadena("Correo electrónico", $patron_email, $email);
$validez_url = validar_cadena("URL", $patron_url, $url);
$validez_contraseña = validar_cadena("Contraseña", $patron_contraseña, $contraseña);
$validez_ipv4 = validar_cadena("Dirección IPv4", $patron_ipv4, $ipv4);
$validez_mac = validar_cadena("Dirección MAC", $patron_mac, $mac);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer13</title>
</head>
<body>
    <p><?php echo $validez_codigo_postal; ?></p>
    <p><?php echo $validez_nif; ?></p>
    <p><?php echo $validez_fecha; ?></p>
    <p><?php echo $validez_texto; ?></p>
    <p><?php echo $validez_numeros; ?></p>
    <p><?php echo $validez_email; ?></p>
    <p><?php echo $validez_url; ?></p>
    <p><?php echo $validez_contraseña; ?></p>
    <p><?php echo $validez_ipv4; ?></p>
    <p><?php echo $validez_mac; ?></p>
</body>
</html>
