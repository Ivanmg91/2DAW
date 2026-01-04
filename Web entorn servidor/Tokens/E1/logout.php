<?php
session_start();

$CookieInfo = session_get_cookie_params();

if ((empty($CookieInfo['domain'])) && (empty($CookieInfo['secure'])) ) {
    setcookie(session_name(), '', time()-3600, $CookieInfo['path']);

} elseif (empty($CookieInfo['secure'])) { 
    setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain']);

} else { 
    setcookie(session_name(), '', time()-3600, $CookieInfo['path'], $CookieInfo['domain'], $CookieInfo['secure']);
}

session_destroy();

header("Location: index.php");
exit();
?>