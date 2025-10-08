<!-- menu_basico CON ARRAY ASOCIATIVO-->

<?php

function pedirNumeroOpciones() {

    $opcionesMenu = 0;

    while (!is_numeric($opcionesMenu) || (int)$opcionesMenu == 0) {
        echo "¿Cuántas opciones tendrá el menú (debe de ser un número)?: ";
        $opcionesMenu = rtrim(fgets(STDIN));
    }

    $opcionesMenu = (int)$opcionesMenu;

    return (int)$opcionesMenu;
}

function pedirCaracterSalir() {
    echo "Introduce el carácter para terminar el programa: ";
    $salirMenu = rtrim(fgets(STDIN));

    return $salirMenu;
}


function crearOpcionesMenu($opcionesMenu, $salirMenu) {
    for ($i = 0; $i < $opcionesMenu; $i++) {
        echo "Introduce el caracter para seleccionar la opción del menú " . ($i + 1) . ": ";
        $opcion = rtrim(fgets(STDIN));

        echo "Introduce el texto de la opción $opcion: ";
        $texto = rtrim(fgets(STDIN));

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
        $opcionElegida = rtrim(fgets(STDIN));
        
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

menu();

?>

