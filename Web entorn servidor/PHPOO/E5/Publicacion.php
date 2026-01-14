<?php
abstract class Publicacion {
    protected $ISBN;
    protected $titulo;
    protected $anio;

    public function __construct($ISBN, $titulo, $anio = 2024) {
        $this->ISBN = $ISBN;
        $this->titulo = $titulo;
        $this->anio = $anio;
    }

    abstract public function __toString();
}
?>