<?php
session_start();

// Verificamos el token que viene por la URL
if (!isset($_GET['token']) || !hash_equals($_SESSION['token'], $_GET['token'])) {
    die("Error: Intento de cierre de sesión no autorizado (Token inválido). <a href='index.php'>Volver</a>");
}

// Borrado seguro de sesión
$CookieInfo = session_get_cookie_params();
if ((empty($CookieInfo['domain'])) && (empty($CookieInfo['secure']))) {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path']);
} else {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain'], $CookieInfo['secure']);
}

session_destroy();
header("Location: index.php");
exit();
?>