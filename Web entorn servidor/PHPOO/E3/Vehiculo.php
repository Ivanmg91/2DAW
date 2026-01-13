<?php 

    class Vehiculo {

        private static $vehiculosCreados = 0;
        private static $kilometrosTotales = 0;
        protected $kilometrosRecorridos;

        public function __construct() {
            $this->kilometrosRecorridos = 0;
            self::$vehiculosCreados++;
        }

        public function avanza($kilometros) {
            $this->kilometrosRecorridos += $kilometros;
            self::$kilometrosTotales += $kilometros;
        }

        public function verKMRecorridos() {
            return "Km recorridos: " . $this->kilometrosRecorridos;
        }

        public static function verKMTotales() {
            return "Total Km recorridos por todos los vehículos: " . self::$kilometrosTotales . "<br>\n";
        }

        public static function verVehiculosCreados() {
            return "Total vehículos creados: " . self::$vehiculosCreados . "<br>\n";
        }
    }

?>