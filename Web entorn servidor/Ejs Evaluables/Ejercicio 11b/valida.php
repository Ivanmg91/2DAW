<?php

// Validar que un campo no esté vacío
function validaRequerido($valor) {
    return trim($valor) !== '';
}

// Validar formato de email
function validaEmail($valor) {
    return filter_var($valor, FILTER_VALIDATE_EMAIL) !== FALSE;
}

// Validar longitud de contraseña (mínimo 6 caracteres)
function validaContrasena($valor) {
    return strlen(trim($valor)) >= 6;
}

// Validar Nacionalidad
function validaNacionalidad($radioValue, $textoOtra) {
    if ($radioValue === 'espanola') {
        return true;
    }
    if ($radioValue === '' && trim($textoOtra) !== '') {
        return true;
    }
    return false;
}