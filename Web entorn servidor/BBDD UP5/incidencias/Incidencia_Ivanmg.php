<?php

/**
 * @author Iván Montiano González
 * Incidencia.php
 */

class Incidencia {
    // PROPIEDADES
    private $codigo;
    private $puesto;
    private $problema;
    private $resolucion;
    private $estado;
    
    private static $pendientes = 0;
    private static $codigos = 0;

    // CONSTRUCTOR
    public function __construct($puesto, $problema) {
        $this->puesto = $puesto;
        $this->problema = $problema;
        $this->estado = "Pendiente";
        $this->resolucion = "";

        self::$pendientes++;
        self::$codigos++;

        $this->codigo = self::$codigos;
    }

    // Función getter para devolver el codigo
    public function getCodigo() {
        return $this->codigo;
    }


    // Función para resolver una incicendia y actualizar la bd
    public function resuelve($resolucion) {
        $this->resolucion = $resolucion;
        $this->estado = "Resuelta";
        self::$pendientes--;

        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Actualizar la bd
            $query = "UPDATE INCIDENCIA SET ESTADO='Resuelta', RESOLUCION=? WHERE CODIGO=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($resolucion, $this->codigo));

        } catch (PDOException $e) {
            print "Error al resolver: " . $e->getMessage();
        }
    }

    // Función para actlizar una incidencia
    public function actualizaIncidencia($puesto, $problema, $resolucion, $estado) {
        // Actualizar propiedades
        if ($puesto != "") $this->puesto = $puesto;
        if ($problema != "") $this->problema = $problema;
        if ($resolucion != "") $this->resolucion = $resolucion;
        if ($estado != "") $this->estado = $estado;

        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Actualizar bd
            $query = "UPDATE INCIDENCIA SET PUESTO=?, PROBLEMA=?, RESOLUCION=?, ESTADO=? WHERE CODIGO=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($this->puesto, $this->problema, $this->resolucion, $this->estado, $this->codigo));
            
            print "Incidencia " . $this->codigo . " modificada correctamente.<br>";
            
            self::leeIncidencia($this->codigo);

        } catch (PDOException $e) {
            print "Error al actualizar: " . $e->getMessage();
        }
    }

    // Función para borrar una incidencia
    public function borraIncidencia() {
        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Borrar de la bd
            $query = "DELETE FROM INCIDENCIA WHERE CODIGO=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($this->codigo));

            print "Incidencia " . $this->codigo . " borrada correctamente.<br>";
            
            // Ajustamos el contador de pendientes
            if ($this->estado == "Pendiente") self::$pendientes--;

        } catch (PDOException $e) {
            print "Error al borrar: " . $e->getMessage();
        }
    }

    public function __toString() {
        $salida = "Incidencia " . $this->codigo . " Puesto: " . $this->puesto . " - " . $this->problema;
        if ($this->estado == "Resuelta") {
            $salida .= " - Resuelta - " . $this->resolucion;
        } else {
            $salida .= " - " . $this->estado;
        }
        return $salida . "<br>";
    }

    // Fucnión para devolver las incidencias pendientes
    public static function getPendientes() {
        return self::$pendientes . "<br>";
    }

    // Función para restablecer la bd
    public static function resetearBD() {
        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "DROP TABLE IF EXISTS INCIDENCIA;
            CREATE TABLE INCIDENCIA (
                CODIGO INTEGER AUTO_INCREMENT,
                ESTADO VARCHAR (100) NOT NULL,
                PUESTO VARCHAR (15),
                PROBLEMA VARCHAR(255),
                RESOLUCION VARCHAR(255),
                CONSTRAINT PK_CODIGO PRIMARY KEY(CODIGO)
            );";
            
            $pdo->exec($query);
            // Reseteamos contadores 
            self::$codigos = 0;
            self::$pendientes = 0;

        } catch (PDOException $e) {
            print "No se ha podido resetear la BD. Error: " . $e->getMessage();
        }
    }

    // Función para crear una incidencia
    public static function creaIncidencia($numPuesto, $errIncidencia) {
        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insertar a la bd
            $query = "INSERT INTO INCIDENCIA (ESTADO, PUESTO, PROBLEMA, RESOLUCION) VALUES (?, ?, ?, ?)";
            $SQLstring = $pdo->prepare($query);
            $SQLstring->execute(array('Pendiente', $numPuesto, $errIncidencia, ''));

            $queryId = "SELECT MAX(CODIGO) FROM INCIDENCIA";
            $SQLstring = $pdo->prepare($queryId);
            $SQLstring->execute();
            $idReal = $SQLstring->fetchColumn();

            // Actualizar el objeto
            $nuevaIncidencia = new Incidencia($numPuesto, $errIncidencia);
            $nuevaIncidencia->codigo = $idReal;

            print "La incidencia con código $idReal se ha creado correctamente.<br>";
            
            // Llamamos a leeIncidencia para mostrarla
            self::leeIncidencia($idReal);

            return $nuevaIncidencia;

        } catch (PDOException $e) {
            print "No se ha podido insertar. Error: " . $e->getMessage();
        }
    }

    // Función para leer una incidencia
    public static function leeIncidencia($codigo) {
        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // query parametrizada
            $query = "SELECT * FROM INCIDENCIA WHERE CODIGO = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($codigo));

            // Fetch para coger una sola fila
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fila) {
                print "Incidencia " . $fila['CODIGO'] . " Puesto: " . $fila['PUESTO'] . " - " . $fila['PROBLEMA'] . " - " . $fila['ESTADO'];
                if ($fila['RESOLUCION'] != "") {
                    print " - " . $fila['RESOLUCION'];
                }
                print "<br>";
            } 

        } catch (PDOException $e) {
            print "Error al leer incidencia: " . $e->getMessage();
        }
    }

    // Función para leer todas las incidencias
    public static function leeTodasIncidencias() {
        try {
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            print "<h3>Listado de Incidencias (Desde BD)</h3>";
            
            $query = "SELECT * FROM INCIDENCIA";
            $stmt = $pdo->query($query);
            
            // Recorremos con fetchAll
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($resultados as $fila) {
                print "Incidencia " . $fila['CODIGO'] . " - Puesto: " . $fila['PUESTO'] . " - " . $fila['ESTADO'] . "<br>";
            }
            print "<br>";

        } catch (PDOException $e) {
            print "Error al leer todas: " . $e->getMessage();
        }
    }
}
?>