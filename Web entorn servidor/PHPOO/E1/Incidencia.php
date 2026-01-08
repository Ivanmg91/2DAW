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
            
            self::$pendientes++;

            self::$codigos++;
            $this->codigo = self::$codigos;
        }

        public function resuelve($resolucion) {
            $this->resolucion = $resolucion;
            $this->estado = "Resuelta";
            
            self::$pendientes--;
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
    }

?>