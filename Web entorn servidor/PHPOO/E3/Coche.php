<?php
include_once "Vehiculo.php";

class Coche extends Vehiculo {

    public function quemaRueda() {
        echo "Quemando rueda con el coche<br>\n";
    }

    public function llenarDeposito() {
        return "Depósito lleno.<br>\n";
    }

    public function verKMRecorridos() {
        return "El coche ha recorrido: " . $this->kilometrosRecorridos . " Km.<br>\n";
    }
}
?>