<?php

    $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
    $confirmacion = isset($_POST['confirmacion']) ? $_POST['confirmacion'] : null;
    $publicidad = isset($_POST['publicidad']);

    $pueba = "no hay nada";

    if ($correo !== $confirmacion) {
        echo "Ambos correos no coinciden.";
    } else if ($correo === $confirmacion) {
        echo "Correo: " . $correo . "<br>";
    }

    if ($publicidad === true) {
        echo "Has aceptado recibir publicidad";
    } else if ($publicidad == false) {
        echo "No has aceptado recibir publicidad";
    }

    

?>

