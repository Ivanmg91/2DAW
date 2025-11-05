<?php

$u_anterior = $_COOKIE["usuario"] ?? null;
$a_anterior = $_COOKIE["accion"] ?? null;

$u_actual = $_POST["nombre"];
$a_actual = $_POST["accion"];

echo "$u_actual<br>";
echo "$a_actual<br>";

echo "$u_anterior<br>";
echo "$a_anterior<br><br>";

setcookie("usuario", $_POST["nombre"]);
setcookie("accion", $_POST["accion"]);



?>
