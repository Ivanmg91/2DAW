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

    public function __construct($puesto, $problema) {
        $this->puesto = $puesto;
        $this->problema = $problema;
        $this->estado = "Pendiente";
        $this->resolucion = "";

        self::$pendientes++;

        self::$codigos++;
        $this->codigo = self::$codigos;
    }

    public function resuelve($resolucion) {
        $this->resolucion = $resolucion;
        $this->estado = "Resuelta";

        self::$pendientes--;

        // CODIGO PARA HACER EL UPDATE EN LA BD
    }

    public function __toString() {
        $salida = "Incidencia " . $this->codigo . " Puesto: " . $this->puesto . " - " . $this->problema;

        if ($this->estado == "Resuelta") {
            $salida .= " - Resuelta - " . $this->resolucion;
        } else {
            $salida .= " - " . $this->estado;
        }

        return $salida . "\n";
    }

    public static function getPendientes() {
        return self::$pendientes;
    }


    // Funciones BD
    public static function resetearBD() {
        try {

            // Crear conexion
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Creamos la query
            $query = "DROP DATABASE IF EXISTS INCIDENCIAS;
            CREATE DATABASE INCIDENCIAS;
            USE INCIDENCIAS;
            CREATE TABLE INCIDENCIA (
                CODIGO INTEGER AUTO_INCREMENT,
                ESTADO VARCHAR (100) NOT NULL,
                PUESTO VARCHAR (15),
                PROBLEMA VARCHAR(255),
                RESOLUCION VARCHAR(255),
                CONSTRAINT PK_CODIGO PRIMARY KEY(CODIGO)
                );";

                // Ejecutamos la query
                $pdo->exec($query);

                // print("Se ha reseteado la BD");

        } catch (PDOException $e) {
            print "No se ha podido resetear la BD. Error: " . $e->getMessage();
        }
    }

    public static function creaIncidencia($numPuesto, $errIncidencia) {
        try {
            // Crear conexion
            $pdo = new PDO('mysql:host=192.168.1.109:3306;dbname=INCIDENCIAS', 'developerphp', 'developerphp');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Creamos la query parametrizada
            $query = "INSERT INTO INCIDENCIA (ESTADO, PUESTO, PROBLEMA, RESOLUCION) VALUES (?, ?, ?, ?)";
            // Preparamos la query
            $SQLstring = $pdo->prepare($query);
            // Añadir los valores a la query en la ejecución
            $SQLstring->execute(array('Pendiente', $numPuesto, $errIncidencia, 'Sin resolver'));


            // Hacemos posible que se guarde en variable lo que subimos
            $queryId = "SELECT MAX(CODIGO) FROM INCIDENCIA";
            $SQLstring = $pdo->prepare($queryId);
            $SQLstring->execute();

            $idReal = $SQLstring->fetchColumn();

            $nuevaIncidencia = new Incidencia($numPuesto, $errIncidencia);
            $nuevaIncidencia->codigo = $idReal;

            return $nuevaIncidencia;

        } catch (PDOException $e) {
            print "No se ha podido insertar a la BD. Error: " . $e->getMessage();
        }
    }
}

?>
