<?php

function pedirNumeroOpciones() {
    $opcionesMenu = 0;
    while (!is_numeric($opcionesMenu) || (int)$opcionesMenu == 0) {
        echo "¿Cuántas opciones tendrá el menú (debe de ser un número)?: ";
        $opcionesMenu = readline();
    }
    return (int)$opcionesMenu;
}

function pedirCaracterSalir() {
    echo "Introduce el carácter para terminar el programa: ";
    return readline();
}

function crearOpcionesMenu($opcionesMenu, $salirMenu) {
    $opciones = [];

    for ($i = 0; $i < $opcionesMenu; $i++) {
        echo "Introduce el caracter para seleccionar la opción del menú " . ($i + 1) . ": ";
        $opcion = readline();

        echo "Introduce el texto de la opción $opcion: ";
        $texto = readline();

        echo "¿Esta opción tendrá un submenú? (s/n): ";
        $tieneSubmenu = strtolower(readline());

        if ($tieneSubmenu == 's') {
            echo "\nCreando submenú para la opción '$texto' \n";
            $numSubOpciones = pedirNumeroOpciones();
            $opciones[$opcion] = [
                'texto' => $texto,
                'submenu' => crearOpcionesMenu($numSubOpciones, $salirMenu)
            ];
        } else {
            $opciones[$opcion] = [
                'texto' => $texto,
                'submenu' => null
            ];
        }
    }

    $opciones["SALIR"] = [
        'texto' => $salirMenu,
        'submenu' => null
    ];

    return $opciones;
}


function mostrarMenu($opciones, $salirMenu, $nivel = "principal") {
    $opcionElegida = "";

    do {
        echo "\nMENÚ $nivel\n";
        foreach ($opciones as $opcion => $datos) {
            echo "[$opcion] {$datos['texto']}\n";
        }

        echo "Elige una opción: ";
        $opcionElegida = readline();

        if ($opcionElegida == $salirMenu) {
            echo "Saliendo del menú $nivel\n";
            break;
        }

        if ($opciones[$opcionElegida]) {
            $seleccion = $opciones[$opcionElegida];
            echo "Has elegido la opción '$seleccion[texto]' del menú $nivel.\n";

            if ($seleccion['submenu'] !== null) {
                mostrarMenu($seleccion['submenu'], $salirMenu, "submenu de '$seleccion[texto]'");
            }
        } else {
            echo "Opción no válida.\n";
        }

    } while ($opcionElegida != $salirMenu);
}


function menu() {
    $salirMenu = pedirCaracterSalir();
    $opcionesMenu = pedirNumeroOpciones();
    $menu = crearOpcionesMenu($opcionesMenu, $salirMenu);
    mostrarMenu($menu, $salirMenu, "principal");
}

menu();
?>
