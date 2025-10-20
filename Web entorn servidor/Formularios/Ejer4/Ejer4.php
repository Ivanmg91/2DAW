<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $llam1 = $_POST['1'];
    $llam2 = $_POST['2'];
    $llam3 = $_POST['3'];
    $llam4 = $_POST['4'];
    $llam5 = $_POST['5'];

    $precio1 = 10;
    $precio2 = 10;
    $precio3 = 10;
    $precio4 = 10;
    $precio5 = 10;

    if ($llam1 > 3) {
        for ($i=0; $i < ($llam1 - 3); $i++) { 
            $precio1 += 5;
        }
    }
    
    if ($llam2 > 3) {
        for ($i=0; $i < ($llam2 - 3); $i++) { 
            $precio2 += 5;
        }
    }

    if ($llam3 > 3) {
        for ($i=0; $i < ($llam3 - 3); $i++) { 
            $precio3 += 5;
        }
    }

    if ($llam4 > 3) {
        for ($i=0; $i < ($llam4 - 3); $i++) { 
            $precio4 += 5;
        }
    }

    if ($llam5 > 3) {
        for ($i=0; $i < ($llam5 - 3); $i++) { 
            $precio5 += 5;
        }
    }

    //los pasamos a euros
    $precio1 /= 100;
    $precio2 /= 100;
    $precio3 /= 100;
    $precio4 /= 100;
    $precio5 /= 100;

    $resultado = $precio1 + $precio2 + $precio3 + $precio4 + $precio5;
    echo "<p>LLamada 1 = $precio1 euros</p>";
    echo "<p>LLamada 2 = $precio2 euros</p>";
    echo "<p>LLamada 3 = $precio3 euros</p>";
    echo "<p>LLamada 4 = $precio4 euros</p>";
    echo "<p>LLamada 5 = $precio5 euros</p>";
    echo "<p>Precio Total = $resultado euros</p>";
} else {
    echo "<p>Error: no se ha recibido la información del formulario.</p>";
}
?>
