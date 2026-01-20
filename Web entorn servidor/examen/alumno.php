<?php
    session_start();
    include("./validaciones.php");


    // recibir variables
    $accion = $_POST['accion'] ?? null;

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $codigo_postal = $_POST['codigo_postal'];
    $rol = $_POST['rol'];
    $alojamiento = $_POST['alojamiento'];
    $preferencia_servicios = $_POST['preferencia_servicios'];
    $alquiler = $_POST['alquiler'];

    $errores = [];

    // validar los campos


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // En caso de q los errores sean 0
        if (count($errores) === 0) {
            
            if ($accion === "Validar") { // En caso de pulsar validar
                echo "Has pulsado validar";
            } 

        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="alumno.php" method="POST" y enctype="multipart/form-data">
        Usuario: <input type="text" name="usuario"><br>
        Password: <input type="text" name="password"><br>
        Nombre: <input type="text" name="nombre"><br>
        Email: <input type="email" name="email"><br>
        Dirección: <input type="text" name="direccion"><br>
        Código Postal: <input type="number" name="codigo_postal"><br>
        Rol<br><input type="radio" name="rol" value="nuevo" checked>Nuevo Usuario <br>
        <input type="radio" name="rol" value="registrado">Registrado <br><br>

        Tipo Alojamiento <br>
        <SELECT MULTIPLE SIZE="4" NAME="alojamiento[]">
            <OPTION VALUE="chalet" SELECTED>Chalet</OPTION>
            <OPTION VALUE="piso">Piso</OPTION>
            <OPTION VALUE="apartamento">Apartamento</OPTION>
            <OPTION VALUE="cabanya">Cabaña</OPTION>
            <OPTION VALUE="casa_rural">Casa Rural</OPTION>
        </SELECT><br><br>

        Preferencias de Servicios: 
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="zona_comercial" CHECKED>Zona Comercial
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="piscina">Piscina
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="parking">Parking
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="parque_infantil">Parque Infantil
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="transporte_publico">Transporte Público
        <INPUT TYPE="checkbox" NAME="preferencia_servicios[]" VALUE="amueblado">Amueblado

        <br>

        Opción de Alquiler
        <SELECT NAME="alquiler">
            <OPTION VALUE="dias" SELECTED>Días</OPTION>
            <OPTION VALUE="semanas">Semanas</OPTION>
            <OPTION VALUE="meses">Meses</OPTION>
        </SELECT>

        <br><br>

        <input type="submit" name="accion" value="Validar">
        <input type="submit" name="accion" value="Enviar">
        <button type="reset">Limpiar</button>

    </form>
</body>
</html>