<?php

function mostrarMenu($opciones, $salirMenu, $pedidos) {
    do {
        echo "\nMENÚ PEDIDOS \n";
        foreach ($opciones as $clave => $texto) {
            echo "[$clave] $texto\n";
        }

        echo "\nElige opción: ";
        $opcion = strtoupper(readline());

        switch ($opcion) {
            case "1":
                $pedidos = crearPedido($pedidos);
                break;
            case "2":
                $pedidos = anadirPlato($pedidos);
                break;
            case "3":
                verDetallePedido($pedidos);
                break;
            case "4":
                listarPedidos($pedidos);
                break;
            case $salirMenu:
                echo "Saliendo del programa.\n";
                break;
            default:
                echo "Opción no válida. Inténtalo de nuevo.\n";
        }

    } while ($opcion != $salirMenu);

    return $pedidos;
}
function crearPedido($pedidos) {
    echo "\nIntroduce el número de pedido: ";
    $numero = readline();

    if (isset($pedidos[$numero])) {
        echo "Ya existe un pedido con ese número.\n";
        return $pedidos;
    }

    echo "Introduce el nombre del cliente: ";
    $cliente = readline();

    $pedidos[$numero] = [
        "numeroPedido" => $numero,
        "cliente" => $cliente,
        "platos" => []
    ];

    echo "Pedido $numero creado correctamente para $cliente.\n";

    return $pedidos;
}

function anadirPlato($pedidos) {
    echo "\nIntroduce el número de pedido: ";
    $numero = readline();

    if (!$pedidos[$numero]) {
        echo "No existe un pedido con ese número.\n";
        return $pedidos;
    }

    echo "Nombre del plato: ";
    $nombrePlato = readline();

    echo "Precio del plato (€): ";
    $precio = floatval(readline());

    $pedidos[$numero]['platos'][] = [
        "nombre" => $nombrePlato,
        "precio" => $precio
    ];

    echo "Plato '$nombrePlato' añadido al pedido #$numero.\n";

    return $pedidos;
}

function verDetallePedido($pedidos) {
    echo "\nIntroduce el número de pedido: ";
    $numero = readline();

    if (!$pedidos[$numero]) {
        echo "No existe un pedido con ese número.\n";
        return;
    }

    $pedido = $pedidos[$numero];
    echo "\nDetalle del pedido {$pedido['numeroPedido']} ({$pedido['cliente']}) \n";

    if (empty($pedido['platos'])) {
        echo "No hay platos añadidos todavía.\n";
        return;
    }

    $total = 0;
    foreach ($pedido['platos'] as $plato) {
        echo "- {$plato['nombre']} -> " . number_format($plato['precio'], 2) . " €\n";
        $total += $plato['precio'];
    }

    echo "-------------------------------------\n";
    echo "TOTAL: " . number_format($total, 2) . " €\n";
}

function listarPedidos($pedidos) {
    if (empty($pedidos)) {
        echo "\n No hay pedidos registrados.\n";
        return;
    }

    echo "\nLISTADO DE PEDIDOS\n";
    foreach ($pedidos as $pedido) {
        echo "Pedido {$pedido['numeroPedido']} - Cliente: {$pedido['cliente']} - ";
        echo count($pedido['platos']) . " plato(s)\n";
    }
}

function menu() {
    $opciones = [
        "1" => "Crear un pedido",
        "2" => "Añadir plato a un pedido",
        "3" => "Ver detalle de un pedido (platos y total)",
        "4" => "Listar todos los pedidos",
        "S" => "Salir"
    ];

    $pedidos = [];
    $salirMenu = "S";

    $pedidos = mostrarMenu($opciones, $salirMenu, $pedidos);
}

menu();
?>
