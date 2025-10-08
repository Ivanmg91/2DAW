<!-- menu_basico-->

<?php

$opcionesMenu = 0;
$opciones = [];
$opcionElegida = "";
$salirMenu = "";

while (!is_numeric($opcionesMenu) || (int)$opcionesMenu == 0) {
    echo "¿Cuántas opciones tendrá el menú (debe de ser un número)?: ";
    $opcionesMenu = rtrim(fgets(STDIN));
}

$opcionesMenu = (int)$opcionesMenu;

echo "Introduce el carácter para terminar el programa: ";
$salirMenu = rtrim(fgets(STDIN));

for ($i = 0; $i < $opcionesMenu; $i++) {
    echo "Introduce el caracter para seleccionar la opción del menú " . ($i + 1) . ": ";
    $opcion = rtrim(fgets(STDIN));

    echo "Introduce el texto de la opción $opcion: ";
    $texto = rtrim(fgets(STDIN));

    $opciones[$opcion] = $texto;
}

$opciones["SALIR"] = $salirMenu;

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


?>

