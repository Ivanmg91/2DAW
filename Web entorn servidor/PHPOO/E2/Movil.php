<?php

    include "Terminal.php";

    class Movil extends Terminal {

        private $tarifa;
        private $tiempoTarifa;

        public function __construct($numero, $tarifa){
            parent::__construct($numero);
            $this->tarifa = $tarifa;
            $this->tiempoTarifa = 0;
        }

        public function llama($terminal, $segundosDeLlamada)
        {
            parent::llama($terminal, $segundosDeLlamada);

            $this->tiempoTarifa += $segundosDeLlamada;
        }

        public function __toString(){
            $minutosTotal = floor($this->tiempoConversacion / 60);
            $segundosTotal = $this->tiempoConversacion % 60;

            $minutosTarif = floor($this->tiempoTarifa / 60);
            $segundosTarif = $this->tiempoTarifa % 60;

            $costeMinuto = 0;
            switch ($this->tarifa) {
                case 'rata': $costeMinuto = 6; break;
                case 'mono': $costeMinuto = 12; break;
                case 'bisonte': $costeMinuto = 30; break;
            }

            $importe = ($this->tiempoTarifa / 60) * ($costeMinuto / 100);

            return "Nº " . $this->numero . " – " . $minutosTotal . " m y " . $segundosTotal . "s de conversación en total - " . "tarificados " . $minutosTarif . " m y " . $segundosTarif . " s " . "por un importe de " . number_format($importe, 2) . " euros"; // number_format redondea a 2 decimales
        }
    }

?>