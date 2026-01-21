<?php
// Archivo de validaciones para completar por el alumnado
// Debéis implementar las funciones usando las funciones de php vistas en clase (diapositivas)
// No se permite usar expresiones regulares en este ejercicio.

function validaRequerido($valor){
    // Debe devolver true si el valor NO está vacío
    if(trim($valor) == "") {
        return false;
    } else {
        return true;
    }
}

function validaEmail($valor){
    // Debe validar un email 
    if (filter_var($valor, FILTER_VALIDATE_EMAIL) === false) {
        return false;
    } else {
        return true;
    }
}

function validaAlfabeto($valor){
    // Debe devolver true si el valor contiene SOLO letras
    if (ctype_alpha($valor)) {
        return true;
    } else {
        return false;
    }
}
function validaAlfanum($valor){
    // Debe devolver true si el valor contiene SOLO letras y números 
    
    if (ctype_alnum($valor)) {
        return true;
    } else {
        return false;
    }
}

function validaNumero($valor){
    // Debe devolver true si el valor contiene SOLO números 
    
    if (is_numeric($valor)) {
        return true;
    } else {
        return false;
    }
}

?>
