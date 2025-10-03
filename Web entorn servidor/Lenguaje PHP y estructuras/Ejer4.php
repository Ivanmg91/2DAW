<?php

function crearListaNumeros() {
    for ($i=0; $i < 20; $i++) { 
        $random = rand(0, 100);
        $listaNumeros[$i] = $random;
    }
    
    return $listaNumeros;
}

function calcularCuadradoLista($listaNumeros) {

    $cuadrado = [];

    for ($i=0; $i < count($listaNumeros); $i++) { 
        $cuadrado[$i] = $listaNumeros[$i] * $listaNumeros[$i];
    }

    return $cuadrado;
}

function calcularCuboLista($listaNumeros) {

    $cubo = [];

    for ($i=0; $i < count($listaNumeros); $i++) { 
        $cubo[$i] = $listaNumeros[$i] * $listaNumeros[$i] * $listaNumeros[$i];
    }

    return $cubo;
}

$numero = crearListaNumeros();
$cuadrado = calcularCuadradoLista($numero);
$cubo = calcularCuboLista($numero);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <table border="5">
        <tr>
            <td>Número</td>
            <td>Cuadrado</td>
            <td>Cubo</td>
        </tr>
        <?php for ($i = 0; $i < count($numero); $i++): ?>
        <tr>
            <td><?php echo $numero[$i]; ?></td>
            <td><?php echo $cuadrado[$i]; ?></td>
            <td><?php echo $cubo[$i]; ?></td>
        </tr>
        <?php endfor; ?>
    </table>
</body>
</html>