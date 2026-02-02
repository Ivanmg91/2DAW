<?php
// Limpia la sesión relacionada con el examen y redirige al formulario.

session_start();

require_once __DIR__ . '/../validaciones.php';

function limpiarSesionFormulario(): void {
	unset($_SESSION['datos_form'], $_SESSION['errores'], $_SESSION['foto'], $_SESSION['aprendiz']);
}


limpiarSesionFormulario();

header('Location: index.php');
exit;
