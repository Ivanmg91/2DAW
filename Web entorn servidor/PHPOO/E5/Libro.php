<?php
include_once 'Publicacion.php';
include_once 'Prestable.php';

class Libro extends Publicacion implements Prestable {
    
    private $prestado;
    public function __construct($ISBN, $titulo, $anio = 2024) {
        parent::__construct($ISBN, $titulo, $anio);
        $this->prestado = false;
    }

    public function presta() {
        if ($this->prestado) {
            echo "No se ha podido prestar, el libro '" . $this->titulo . "' ya está prestado.\n";
        } else {
            $this->prestado = true;
            echo "Se ha prestado el libro '" . $this->titulo . "'.\n";
        }
    }

    public function devuelve() {
        $this->prestado = false;
        echo "Se ha devuelto el libro '" . $this->titulo . "'.\n";
    }

    public function estaPrestado() {
        return $this->prestado;
    }

    public function mostrarPrestado() {
        if ($this->prestado) {
            echo "El libro '" . $this->titulo . "' está prestado\n";
        }
    }

    public function __toString() {
        $estado = $this->prestado ? "(prestado)" : "(no prestado)";
        
        return "ISBN: " . $this->ISBN . ", título: " . $this->titulo . ", año de publicación: " . $this->anio . " " . $estado . "\n";
    }
}
?>