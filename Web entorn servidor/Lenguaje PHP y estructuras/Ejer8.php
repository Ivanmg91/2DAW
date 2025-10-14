<?php

function pedirNumeroOpciones() {

    $opcionesMenu = 0;

    while (!is_numeric($opcionesMenu) || (int)$opcionesMenu == 0) {
        echo "¿Cuántas opciones tendrá el menú (debe de ser un número)?: ";
        $opcionesMenu = readline();
    }

    $opcionesMenu = (int)$opcionesMenu;

    return (int)$opcionesMenu;
}

function pedirCaracterSalir() {
    echo "Introduce el carácter para terminar el programa: ";
    $salirMenu = readline();

    return $salirMenu;
}


function crearOpcionesMenu($opcionesMenu, $salirMenu) {
    for ($i = 0; $i < $opcionesMenu; $i++) {
        echo "Introduce el caracter para seleccionar la opción del menú " . ($i + 1) . ": ";
        $opcion = readline();

        echo "Introduce el texto de la opción $opcion: ";
        $texto = readline();

        $opciones[$opcion] = $texto;
    }

    $opciones["SALIR"] = $salirMenu;

    return $opciones;
}

function mostrarMenu($opciones, $salirMenu) {

    $opcionElegida = "";

    echo "Este es tu menu: \n";
    foreach ($opciones as $opcion => $texto) {
        echo "[$opcion] $texto\n";
    }

    while ($opcionElegida != $salirMenu) {

        echo "Introduce una opción: ";
        $opcionElegida = readline();
        
        foreach ($opciones as $opcion => $texto) {
            if ($opcionElegida == $opcion) {
                echo "Has elegido la opción > $opciones[$opcion] <\n";
            }
        }

        echo "Este es tu menu: \n";
        foreach ($opciones as $opcion => $texto) {
            echo "[$opcion] $texto\n";
        }
        
    }
}

function menu() {

    $salirMenu = pedirCaracterSalir();

    mostrarMenu(crearOpcionesMenu(pedirNumeroOpciones(), $salirMenu), $salirMenu);
}

// COMIENZO PROGRAMA
menu();

?>

