<?php
    // Comprobamos si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos los datos del formulario comprobando si se han subido
        $nombre_completo = isset($_POST['nombre_completo']) ? $_POST['nombre_completo'] : null;
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
        $estudios = isset($_POST['estudios']) ? $_POST['estudios'] : null;
        $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : null;

        if ($nacionalidad === "") {
            $nacionalidad = $_POST['otra'];
        }

        $idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultados</title>
    </head>
    <body>
        <h3>Nombre Completo</h3>
        <p><?php echo $nombre_completo ?></p>

        <h3>Contraseña</h3>
        <p><?php echo $contrasena ?></p>

        <h3>Estudios</h3>
        <p><?php echo $estudios ?></p>

        <h3>Nacionalidad</h3>
        <p><?php echo $nacionalidad ?></p>

        <h3>idiomas</h3>
        <p><?php 
            foreach ($idiomas as $idioma) {
                echo "$idioma ";
            }
        ?></p>

        <h3>Email</h3>
        <p><?php echo $email ?></p>

        <h3>Imagen</h3>
        <p><?php 
            // echo "name:".$_FILES['imagen']['name']."\n";
            // echo "tmp_name:".$_FILES['imagen']['tmp_name']."\n";
            // echo "size:".$_FILES['imagen']['size']."\n";
            // echo "type:".$_FILES['imagen']['type']."\n";
        ?></p>
    </body>
    </html>

<?php
    } else if (!isset($_POST['formulario'])) {
        echo "Error, no se ha enviado el formulario.";
    }
?>