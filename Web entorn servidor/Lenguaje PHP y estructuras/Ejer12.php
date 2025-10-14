<?php

function mostrarMenu($opciones, $salirMenu, $biblioteca) {
    do {
        echo "\nMENÚ BIBLIOTECA\n";
        foreach ($opciones as $clave => $texto) {
            echo "[$clave] $texto\n";
        }

        echo "\nElige una opción: ";
        $opcion = readline();

        switch ($opcion) {
            case "1":
                $biblioteca = anadirLibro($biblioteca);
                break;
            case "2":
                listarLibros($biblioteca);
                break;
            case "3":
                $biblioteca = prestarLibro($biblioteca);
                break;
            case "4":
                $biblioteca = devolverLibro($biblioteca);
                break;
            case "5":
                buscarPorAutor($biblioteca);
                break;
            case $salirMenu:
                echo "Saliendo del programa.\n";
                break;
            default:
                echo "Opción no válida. Inténtalo de nuevo.\n";
        }

    } while ($opcion != $salirMenu);

    return $biblioteca;
}


function anadirLibro($biblioteca) {
    echo "\nIntroduce el título del libro: ";
    $titulo = readline();

    if (isset($biblioteca[$titulo])) {
        echo "Ya existe un libro con ese título.\n";
        return $biblioteca;
    }

    echo "Introduce el autor: ";
    $autor = readline();

    echo "Introduce el año de publicación: ";
    $anio = readline();

    $biblioteca[$titulo] = [
        "titulo" => $titulo,
        "autor" => $autor,
        "anio" => $anio,
        "prestado" => false
    ];

    echo "Libro '$titulo' añadido correctamente.\n";
    return $biblioteca;
}

function listarLibros($biblioteca) {
    if (empty($biblioteca)) {
        echo "\nNo hay libros registrados.\n";
        return;
    }

    echo "\nLISTA DE LIBROS\n";
    foreach ($biblioteca as $libro) {
        $estado = $libro['prestado'] ? "Prestado" : "Disponible";
        echo "- {$libro['titulo']} ({$libro['anio']}) | Autor: {$libro['autor']} | Estado: $estado\n";
    }
}

function prestarLibro($biblioteca) {
    echo "\nIntroduce el título del libro a prestar: ";
    $titulo = readline();

    if (!$biblioteca[$titulo]) {
        echo "No existe un libro con ese título.\n";
        return $biblioteca;
    }

    if ($biblioteca[$titulo]['prestado']) {
        echo "El libro ya está prestado.\n";
    } else {
        $biblioteca[$titulo]['prestado'] = true;
        echo "El libro '$titulo' ha sido prestado correctamente.\n";
    }

    return $biblioteca;
}

function devolverLibro($biblioteca) {
    echo "\nIntroduce el título del libro a devolver: ";
    $titulo = readline();

    if (!$biblioteca[$titulo]) {
        echo "No existe un libro con ese título.\n";
        return $biblioteca;
    }

    if (!$biblioteca[$titulo]['prestado']) {
        echo "El libro no estaba prestado.\n";
    } else {
        $biblioteca[$titulo]['prestado'] = false;
        echo "El libro '$titulo' ha sido devuelto correctamente.\n";
    }

    return $biblioteca;
}

function buscarPorAutor($biblioteca) {
    echo "\nIntroduce el nombre del autor a buscar: ";
    $autor = readline();

    $encontrados = [];

    foreach ($biblioteca as $libro) {
        if ($libro['autor'] == $autor) {
            $encontrados[] = $libro;
        }
    }

    if (empty($encontrados)) {
        echo "No se encontraron libros de ese autor.\n";
        return;
    }

    echo "\nLibros encontrados de '$autor':\n";
    foreach ($encontrados as $libro) {
        $estado = $libro['prestado'] ? "Prestado" : "Disponible";
        echo "- {$libro['titulo']} ({$libro['anio']}) | Estado: $estado\n";
    }
}


function menu() {
    $opciones = [
        "1" => "Añadir libro",
        "2" => "Listar libros",
        "3" => "Prestar libro",
        "4" => "Devolver libro",
        "5" => "Buscar libros por autor",
        "S" => "Salir"
    ];

    $biblioteca = [];
    $salirMenu = "S";

    $biblioteca = mostrarMenu($opciones, $salirMenu, $biblioteca);
}

menu();

?>
