<?php

class Alumno {
    
    // 1. PROPIEDADES
    private $usuario;
    private $nombre;
    private $password;
    private $email;
    private $direccion;
    private $cp;
    
    private $registrado; 
    private $estado;     
    private $tipo;       
    private $servicios;  
    private $rutaFoto;   

    // 2. CONSTRUCTOR
    public function __construct($usuario, $nombre, $password, $email, $direccion, $cp, $registrado, $estado, $tipo, $servicios = [], $rutaFoto = '') {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->password = $password; 
        $this->email = $email;
        $this->direccion = $direccion;
        $this->cp = $cp;
        $this->registrado = $registrado;
        $this->estado = $estado;
        $this->tipo = $tipo;
        $this->servicios = $servicios; 
        $this->rutaFoto = $rutaFoto;
    }

    // 3. MÉTODOS GETTERS (Necesarios para el INSERT en controller.php)
    
    public function getUsuario() { return $this->usuario; }
    public function getNombre() { return $this->nombre; }
    
    // IMPORTANTE: Necesitamos este getter para poder hacer el password_hash en el controlador
    public function getPassword() { return $this->password; } 
    
    public function getEmail() { return $this->email; }
    
    // Estos faltaban y son necesarios para el SQL:
    public function getDireccion() { return $this->direccion; }
    public function getCP() { return $this->cp; }
    public function getRegistrado() { return $this->registrado; }
    public function getEstado() { return $this->estado; }
    public function getTipo() { return $this->tipo; }

    // Getter especial (Array a String)
    public function getServiciosTexto() {
        if (empty($this->servicios)) {
            return "Ninguno"; // O devolver cadena vacía "" según prefieras
        }
        return implode(", ", $this->servicios);
    }
    
    // Getter para servicios en formato Array (por si lo necesitas para editar)
    public function getServicios() { return $this->servicios; }

    public function getRutaFoto() { return $this->rutaFoto; }

    // 4. MÉTODO MÁGICO __toString
    public function __toString() {
        return "<div class='ficha-alumno'>" .
               "<p><strong>Usuario:</strong> " . $this->usuario . "</p>" .
               "<p><strong>Nombre:</strong> " . $this->nombre . "</p>" .
               "<p><strong>Email:</strong> " . $this->email . "</p>" .
               "<p><strong>Dirección:</strong> " . $this->direccion . " (" . $this->cp . ")</p>" .
               "<p><strong>Alojamiento:</strong> " . $this->estado . " (" . $this->tipo . ")</p>" .
               "<p><strong>Extras:</strong> " . $this->getServiciosTexto() . "</p>" .
               "</div>";
    }
}
?>