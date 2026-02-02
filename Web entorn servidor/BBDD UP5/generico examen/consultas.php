<!-- CONSULTAS -->

<?php

    /* INSERT */

    // Incluimos la conexión. La variable $pdo ya está disponible.
    require_once __DIR__ . './database.php';

    try {
        // Definimos la sentencia SQL con marcadores
        $sql = "INSERT INTO aprendiz (nombre, apellido, email, edad, rol) VALUES (:nombre, :apellido, :email, :edad, :rol)";

        // Preparamos la sentencia
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nombre'   => 'Harry',
            ':apellido' => 'Potter',
            ':email'    => 'harry.potter@hogwarts.edu',
            ':edad'     => 17,
            ':rol'      => 'Mago'
        ]);


    } catch (PDOException $e) {
        // Captura de errores de SQL
        echo "Error en la base de datos: " . $e->getMessage();
    }
?>












<?php

    /* DELETE */

    // Incluimos la conexión. La variable $pdo ya está disponible.
    require_once __DIR__ . './database.php';

    try {
        // Definimos la sentencia SQL con marcadores
        // Es vital usar el WHERE con un marcador (:id) para no borrar toda la tabla
        $sql = "DELETE FROM aprendiz WHERE id = :id";

        // Preparamos la sentencia
        $stmt = $pdo->prepare($sql);

        // Ejecutamos pasando el ID que queremos eliminar
        // (En un caso real, este ID vendría de un formulario o URL)
        $stmt->execute([
            ':id' => 1 
        ]);

    } catch (PDOException $e) {
        // Captura de errores de SQL
        echo "Error en la base de datos: " . $e->getMessage();
    }
?>




<?php

    /* SELECT (Leer datos) */

    // Incluimos la conexión. La variable $pdo ya está disponible.
    require_once __DIR__ . './database.php';

    try {
        // Definimos la sentencia SQL con marcadores
        // Buscamos todos los aprendices que tengan un rol específico
        $sql = "SELECT * FROM aprendiz WHERE rol = :rol";

        // Preparamos la sentencia
        $stmt = $pdo->prepare($sql);

        // Ejecutamos pasando el filtro que queremos buscar
        $stmt->execute([
            ':rol' => 'Mago'
        ]);

        // Obtenemos TODOS los resultados en un array asociativo (UP5 Pág 21)
        // Como configuramos PDO::FETCH_ASSOC en database.php, devuelve arrays con nombres de columnas
        $resultados = $stmt->fetchAll();

        // Comprobamos si hay resultados
        if ($stmt->rowCount() > 0) {
            
            // Recorremos el array de resultados para mostrarlos
            foreach ($resultados as $fila) {
                echo "Nombre: " . $fila['nombre'] . " " . $fila['apellido'] . "<br>";
                echo "Email: " . $fila['email'] . "<br>";
                echo "--------------------------<br>";
            }

        } else {
            echo "No se encontraron aprendices con ese rol.";
        }

    } catch (PDOException $e) {
        // Captura de errores de SQL
        echo "Error en la base de datos: " . $e->getMessage();
    }
?>