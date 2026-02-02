<?php 
// Cargamos la lógica antes de mostrar nada HTML
require_once 'controller.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>
<body>

<h1>Formulario</h1>

<?php if (!empty($errores)): ?>
    <ul style="color:red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($accion === "Validar"): ?>
    <h3 style="color:green;">Sin errores (Listo para enviar)</h3>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" action="">

    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    
    <p><strong>Usuario:</strong></p>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario) ?>"><br><br>

    <p><strong>Nombre:</strong></p>
    <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>"><br><br>

    <p><strong>Contraseña:</strong></p>
    <input type="password" name="password" value="<?= htmlspecialchars($password) ?>"><br><br>

    <p><strong>Email:</strong></p>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

    <p><strong>Direccion:</strong></p>
    <input type="text" name="direccion" value="<?= htmlspecialchars($direccion) ?>"><br><br>

    <p><strong>CP:</strong></p>
    <input type="number" name="cp" value="<?= htmlspecialchars($cp) ?>"><br><br>

    <p><strong>¿Estás ya registrado?:</strong></p>
    <label><input type="radio" name="registrado" value="Si" <?= $registrado === "Si" ? "checked" : "" ?>> Si</label>
    <label><input type="radio" name="registrado" value="No" <?= $registrado === "No" ? "checked" : "" ?>> No</label>
    <br><br>

    <p><strong>Tipo de instancia:</strong></p>
    <select name="estado">
        <option value="">--Selecciona--</option>
        <option value="Chalet" <?= $estado === "Chalet" ? "selected" : "" ?>>Chalet</option>
        <option value="Piso" <?= $estado === "Piso" ? "selected" : "" ?>>Piso</option>
        <option value="Apartamento" <?= $estado === "Apartamento" ? "selected" : "" ?>>Apartamento</option>
        <option value="Cabanya" <?= $estado === "Cabanya" ? "selected" : "" ?>>Cabanya</option>
        <option value="CasaRural" <?= $estado === "CasaRural" ? "selected" : "" ?>>CasaRural</option>
    </select>
    <br><br>

    <p><strong>Tipo de alquiler:</strong></p>
    <label><input type="radio" name="tipo" value="Dias" <?= $tipo === "Dias" ? "checked" : "" ?>> Dias</label>
    <label><input type="radio" name="tipo" value="Semanas" <?= $tipo === "Semanas" ? "checked" : "" ?>> Semanas</label>
    <label><input type="radio" name="tipo" value="Meses" <?= $tipo === "Meses" ? "checked" : "" ?>> Meses</label>
    <br><br>

    <p><strong>Actividades Extra:</strong></p>
    <label><input type="checkbox" name="servicios[]" value="ZonaComercial" <?= $checkboxZonaComercial ? "checked" : "" ?>> Cine</label><br>
    <label><input type="checkbox" name="servicios[]" value="Piscina" <?= $checkboxPiscina ? "checked" : "" ?>> Deporte</label><br>
    <label><input type="checkbox" name="servicios[]" value="Parking" <?= $checkboxParking ? "checked" : "" ?>> Parking</label><br>
    <label><input type="checkbox" name="servicios[]" value="ParqueInfantil" <?= $checkboxParqueInfantil ? "checked" : "" ?>> Parque Infantil</label><br>
    <label><input type="checkbox" name="servicios[]" value="TransportePublico" <?= $checkboxTransportePublico ? "checked" : "" ?>> Transporte Público</label><br>
    <label><input type="checkbox" name="servicios[]" value="Amueblado" <?= $checkboxAmueblado ? "checked" : "" ?>> Amueblado</label><br>
    <br><br>
    
    <p><strong>Foto:</strong></p>
    <input type="file" name="foto"><br><br>
    
    <a href="form.php"><button type="button">Borrar todo</button></a>
    <input type="submit" name="accion" value="Validar">
    <input type="submit" name="accion" value="Enviar">

</form>
</body>
</html>