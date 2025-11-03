<?php
$curso = $_POST['curso'] ?? '';
$modulo = $_POST['modulo'] ?? '';
$horas = $_POST['horas'] ?? [];


if (!$curso || !$modulo || empty($horas)) {
    echo "Por favor, selecciona todos los campos.";
    exit;
}

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Curso</th><th>Módulo</th><th>Horas</th></tr>";
echo "<tr><td>" . htmlspecialchars($curso) . "</td><td>" . htmlspecialchars($modulo) . "</td><td>";

if (count($horas) > 0) {
    echo "<ul>";
    foreach ($horas as $hora) {
        echo "<li>" . htmlspecialchars($hora) . "</li>";
    }
    echo "</ul>";
} else {
    echo "No se han seleccionado horas.";
}

echo "</td></tr>";
echo "</table>";
?>
