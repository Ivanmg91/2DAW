<?php
/***
 * Formulario para registrar un aprendiz de Hogwarts
 * Requiere sesión para guardar los datos entre peticiones 
 * y un token CSRF para evitar ataques.
 * Se debe validar usando el fichero validaciones.php
 **/

/**
 * PROCESAR FORMULARIO
 */
session_start();


    function validaRequerido($valor){ //Obliga a introducir datos en campos requeridos
        if(trim($valor) == ''){
            return false;
        }else{
            return true;
        }
    }

    function validaEmail($valor){ //valida que se haya introducido un email user@ejemplo.com
        if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaAlfabeto ($valor){
        if (ctype_alpha($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaAlfanum ($valor){
        if (ctype_alnum($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaNumero ($valor){
        if (ctype_digit($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }
















    $nombre = $_POST['nombre'] ?? '';
    $casa = $_POST['casa'] ?? '';
    $varita = $_POST['varita'] ?? '';
    $asignaturas = $_POST['asignaturas'] ?? '';
    $nivel = $_POST['nivel'] ?? '';

    $action = $_POST['action'] ?? '';
    $errores = [];

    // Comprobar token CSRF y finalizar si no es válido
   

    if ($action === 'ENVIAR' || $action === 'VALIDAR') { // SEPARAR EN 2 ***

            /**
             * VALIDACIONES y guardar valores en sesión
             */

            //nombre
            if (!validaRequerido($nombre)) {
                $errores[] = 'Es obligatorio introducir el nombre.';
            }

            if (!validaAlfabeto($nombre)) {
                $errores[] = 'El nombre solo puede contener caracteres del alfabeto.';
            }
        
            //casa 
            if (!validaRequerido($casa)) {
                $errores[] = 'Es obligatorio seleccionar casa.';
            }

            //varita
            if (!validaRequerido($varita)) {
                $errores[] = 'Es obligatorio seleccionar varitas.';
            }

            //asignaturas
            // if (!validaRequerido($asignaturas)) {
            //    $errores[] = 'Debes seleccionar al menos 1 asignatura.';  ESTO ESTABA DESCOMENTADO ***
            // }

            //nivel mágico
            if (!validaRequerido($nivel)) {
               $errores[] = 'Debes introducir el nivel.';
            }

            if (!validaNumero($nivel)) {
               $errores[] = 'El nivel debe ser un valor numérico.';
            }

            //foto
    
        

        //Si no hay foto en sesión, validamos la subida

            // Validar que se ha subido una foto
           
                // Validar extensiones y tamaño de la foto.
                //Si todo OK, guardar datos de la foto en sesión
                
                    /***
                     * GUARDAR LA FOTO EN EL SERVIDOR
                     */
                    
                    //Si no existe se crea la carpeta Uploads
                    
                    //Generamos el nombre final del archivo
                   
                    // nombreAprendiz_timestamp.extensión es el formato final
                   

                    // Mover el archivo subido a la carpeta uploads
                    
                    // Guardar el nombre final en sesión
                    
             //fin validación foto subida
         //fin foto en sesión
     //fin botón validar
    }

    if ($action === 'ENVIAR' && empty($errores)) {// Si se pulsa ENVIAR
            /**
             * GUARDAR EN BASE DE DATOS
             * Los datos ya están validados y se guardan en sesión ($_SESSION)
             * Se redirige a resultado.php con el id del aprendiz
             */

            $nombre = $_POST['nombre'] ?? '';
            $casa = $_POST['casa'] ?? '';
            $varita = $_POST['varita'] ?? '';
            $asignaturas = $_POST['asignaturas'] ?? '';
            $nivel = $_POST['nivel'] ?? '';

            $_SESSION['nombre'] = $nombre;
            $_SESSION['casa'] = $casa;
            $_SESSION['varita'] = $varita;
            $_SESSION['asingaturas'] = $asignaturas;
            $_SESSION['nivel'] = $nivel;

            
        header("Location: resultado.php");
        exit;
    }
    
        
       

    if ($action === 'VALIDAR') { // Si se pulsa VALIDAR

    }
  
?>
<!-- FORMULARIO HTML, pon tu nombre con h1 -->
<h1>Iván Montiano González</h1>


<!-- El listado de errores si los hay -->
<?php if (!empty($errores)): ?>
    <ul style="color:red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- ESTO ERA "Validar" ** -->
<?php elseif ($action === "VALIDAR"): ?>
    <h3 style="color:green;">Sin errores</h3>
<?php endif; ?>


<!-- completar las opciones necesarias del formulario -->
<form action="index.php" method="POST" enctype="multipart/form-data" action="">
    <!-- Campo oculto para el token CSRF -->
    <input type="hidden" name="token" value="">
    <!-- En cada campo debemos devolver los datos correctos 
        $_SESSION['nombre'] ?? '' Si no hay valor en la sesión devolvemos vacío para no devolver null -->
    <p><label>Nombre del aprendiz:</label>
        <input type="text" name="nombre">
    </p>

    <p><label>Casa:</label>
        <select name="casa">
            <option value="Gryffindor">Gryffindor</option>
            <option value="Slytherin">Slytherin</option>
            <option value="Ravenclaw">Ravenclaw</option>
            <option value="Hufflepuff">Hufflepuff</option>
        </select>
        
    </p>

   <p><label>Varita:</label>
        <select name="varita" multiple>
            <option value="Roble">Roble con núcle de fénix</option>
            <option value="Sauce">Sauce con núcleo de unicornio</option>
            <option value="Acebo">Acebo con núcleo de dragón</option>
        </select>
    </p>

   <p><label>Asignaturas favoritas:</label><br>
        <input type="checkbox" name="asignaturas[]" value="Pociones">Pociones<br>
        <input type="checkbox" name="asignaturas[]" value="Encantamientos">Encantamientos<br>
        <input type="checkbox" name="asignaturas[]" value="Defensa">Defensa contral las artes oscuras<br>
    </p>

   <p><label>Nivel mágico (1-100):</label>
        <input type="text" name="nivel" min="1" max="100">
    </p>
    <!-- Campo para subir la foto -->
    <!-- Si ya hay foto en sesión, no mostramos el campo de subida -->
    
    <p><label>Foto del aprendiz:</label><br>
        <input type="file" name="foto">
    </p>
    <!-- Campo oculto para el tamaño máximo de la foto (2MB) -->
    <input type="hidden" name="tamano_maximo" value="2000000">

    <br><br>

    <!-- VALIDAR visible si: ***
         - NO es POST
         - O es POST con errores -->
   
        <button type="submit" name="action" value="VALIDAR">VALIDAR</button>
  

    <!-- ENVIAR visible si: ***
         - ES POST
         - Y NO hay errores -->
   
        <button type="submit" name="action" value="ENVIAR">ENVIAR</button>

</form>


<!-- MANTENER LOS DATOS Q ESTAN CORRECTOS -->