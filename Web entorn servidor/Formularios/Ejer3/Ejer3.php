<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caracter = $_POST['caracter'];
    
    if (!is_numeric($caracter) && strlen($caracter) > 1) {
        echo "<p>Error: solo puedes ingresar un solo carácter si no es un número.</p>";
    } else {
        if (ctype_upper($caracter)) {
            echo "<p>$caracter es una letra mayúscula.</p>";
        } else if (ctype_lower($caracter)) {
            echo "<p>$caracter es una letra minúscula.</p>";
        } else if (is_numeric($caracter)) {
            echo "<p>$caracter es un carácter numérico.</p>";
        } else if (ctype_space($caracter)) {
            echo "<p>$caracter es un espacio en blanco.</p>";
        } else if (ctype_punct($caracter)) {
            echo "<p>$caracter es un carácter de puntuación.</p>";
        } else if (ctype_cntrl($caracter)) {
            echo "<p>$caracter es un carácter de control.</p>";
        } else {
            echo "<p>Error: carácter no reconocido.</p>";
        }
    }
} else {
    echo "<p>Error: no se ha recibido la información del formulario.</p>";
}
?>
