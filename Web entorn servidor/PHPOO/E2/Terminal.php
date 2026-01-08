<?php

    class Terminal {

        protected $numero;
        protected $tiempoConversacion;

        public function __construct($numero){
            $this->numero = $numero;
            $this->tiempoConversacion = 0;
        }

        public function llama($terminal, $segundosDeLlamada) {
            $this->tiempoConversacion += $segundosDeLlamada;
            $terminal = $segundosDeLlamada;
        }
    }

?>