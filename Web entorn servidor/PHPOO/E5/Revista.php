<?php
include_once 'Publicacion.php';

class Revista extends Publicacion {
    private $numero;

    public function __construct($ISBN, $titulo, $anio, $numero) {
        parent::__construct($ISBN, $titulo, $anio);
        $this->numero = $numero;
    }

    public function __toString() {
        return "ISBN: " . $this->ISBN . ", título: " . $this->titulo . ", año de publicación: " . $this->anio . ", número: " . $this->numero . "\n";
    }
}
?>