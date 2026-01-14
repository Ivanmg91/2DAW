<?php
include_once "DniTrait.php"; // Incluimos el fichero del Trait

class Persona {
    use DniTrait;

    private $nombre;
    private $edad;
    private $DNI;
    private $sexo;
    private $peso;
    private $altura;

    const INFRAPESO = -1;
    const PESO_IDEAL = 0;
    const SOBREPESO = 1;

    public function __construct() {
        $this->nombre = "";
        $this->edad = 0;
        $this->sexo = "H";
        $this->peso = 0;
        $this->altura = 0;
        $this->DNI = $this->generarDNI();
    }

    // Como no se puede tener 2 constructores hacemos consFull y consNomEdSex.
    // El constructor de arriba es el constructor por defecto
    public static function consFull($nombre, $edad, $sexo, $peso, $altura) {
        $p = new Persona();
        $p->setNombre($nombre);
        $p->setEdad($edad);
        $p->setSexo($sexo);
        $p->setPeso($peso);
        $p->setAltura($altura);
        return $p;
    }

    public static function consNomEdSex($nombre, $edad, $sexo) {
        $p = new Persona();
        $p->setNombre($nombre);
        $p->setEdad($edad);
        $p->setSexo($sexo);
        return $p;
    }

    private function comprobarSexo($sexo) {
        $sexo = strtoupper($sexo);
        if ($sexo === 'H' || $sexo === 'M') {
            return $sexo;
        } else {
            return 'H';
        }
    }

    public function calcularIMC() {
        if ($this->altura == 0) {
            return self::INFRAPESO;
        }

        $imc = $this->peso / ($this->altura * $this->altura);

        if ($imc < 20) {
            return self::INFRAPESO;
        } elseif ($imc >= 20 && $imc <= 25) {
            return self::PESO_IDEAL;
        } else {
            return self::SOBREPESO;
        }
    }

    public function strIMC() {
        $resultadoIMC = $this->calcularIMC();
        $mensaje = "";

        switch ($resultadoIMC) {
            case self::INFRAPESO:
                $mensaje = "está por debajo de su peso ideal";
                break;
            case self::PESO_IDEAL:
                $mensaje = "está en su peso ideal";
                break;
            case self::SOBREPESO:
                $mensaje = "tiene sobrepeso";
                break;
        }
        return $this->nombre . " " . $mensaje . "<br>\n";
    }

    public function mostrarIMC() {
        return $this->strIMC();
    }

    public function esMayorDeEdad() {
        $esMayor = ($this->edad >= 18);
        $textoMayor = $esMayor ? "mayor" : "menor";
        echo $this->nombre . " con DNI " . $this->DNI . " es " . $textoMayor . " de edad<br>\n";
        
        return $esMayor;
    }

    public function __toString() {
        $sexoTexto = ($this->sexo === 'H') ? "Hombre" : "Mujer";
        
        $salida = "Informacion de la persona:<br>\n";
        $salida .= "DNI: " . $this->DNI . "\n";
        $salida .= "Nombre: " . $this->nombre . "\n";
        $salida .= "Sexo: " . $sexoTexto . "\n";
        $salida .= "Edad: " . $this->edad . "\n";
        $salida .= "Peso: " . $this->peso . " Kg\n";
        $salida .= "Altura: " . $this->altura . " metros\n";
        $salida .= "Resultado IMC: " . trim($this->mostrarIMC()) . "\n";
        
        return $salida;
    }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setEdad($edad) { $this->edad = $edad; }
    
    public function setSexo($sexo) { 
        $this->sexo = $this->comprobarSexo($sexo); 
    }
    
    public function setPeso($peso) { $this->peso = $peso; }
    public function setAltura($altura) { $this->altura = $altura; }
}
?>