<?php

    include "Terminal.php";

    class Movil extends Terminal {

        private $tarifa;

        public function __construct($numero, $tarifa){
            parent::__construct($numero);
            $this->tarifa = $tarifa;
        }

        public function __toString(){


            return "Nº " . $this->numero . " - " . $this->tiempoConversacion;
        }
    }

?>