<?php
    session_start();

    $multiplicando = $_POST["multiplicando"];
    $multiplicador = $_POST["multiplicador"];
    
    $multiplicando_anterior = $_SESSION["multiplicando"] ?? null;
    $multiplicador_anterior = $_SESSION["multiplicador"] ?? null;


    if ($multiplicando && $multiplicador) {
        $_SESSION["multiplicando"] = $multiplicando;
        $_SESSION["multiplicador"] = $multiplicador;
    }

    echo "<style>
        body{
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;        
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>";


    echo "<h1>Tabla de multiplicar del $multiplicando</h1>";

    echo "Multiplicando actual: $multiplicando<br>Multiplicador actual: $multiplicador";

    echo "<table border='1'>";
    for ($multiplicador; $multiplicador <= 10; $multiplicador++) { 
        $resultado = $multiplicador * $multiplicando;

        echo "<tr>";

        // crear las 3 columnas n x m
        echo "<td>$multiplicando</td>";
        echo "<td>x</td>";
        echo "<td>$multiplicador</td>";
        echo "<td>=</td>";
        echo "<td>$resultado</td>";

        echo "</tr>";
    }

    echo "</table>";

    echo "<h1>Tabla de multiplicar del $multiplicando_anterior (anterior)</h1>";

    echo "Multiplicando anterior: $multiplicando_anterior<br>Multiplicador anterior: $multiplicador_anterior";

    echo "<table border='1'>";
    for ($multiplicador_anterior; $multiplicador_anterior <= 10; $multiplicador_anterior++) { 
        $resultado = $multiplicador_anterior * $multiplicando_anterior;

        echo "<tr>";

        // crear las 3 columnas n x m
        echo "<td>$multiplicando_anterior</td>";
        echo "<td>x</td>";
        echo "<td>$multiplicador_anterior</td>";
        echo "<td>=</td>";
        echo "<td>$resultado</td>";

        echo "</tr>";
    }

    echo "</table>";

?>
