<?php 
    class Incidencia {
    // PROPIEDADES
    private $puesto;
    private $problema;
    private $resolucion;
    private $estado;

    // PROPIEDAD ESTÁTICA (Página 6 del PDF)
    // Necesaria para llevar la cuenta global sin depender de un objeto concreto.
    private static $pendientes = 0; 

    // CONSTRUCTOR (Página 12 del PDF)
    // Se ejecuta al hacer 'new Incidencia(...)'.
    public function __construct($puesto, $problema) {
        $this->puesto = $puesto;
        $this->problema = $problema;
        $this->estado = "Pendiente";
        
        // Aumentamos el contador estático usando self:: (Página 6)
        self::$pendientes++;
    }

    // MÉTODO DE INSTANCIA
    // Resuelve la incidencia y actualiza el contador global.
    public function resuelve($resolucion) {
        $this->resolucion = $resolucion;
        $this->estado = "Resuelta";
        
        // Al resolverla, decrementamos el contador de pendientes
        self::$pendientes--;
    }

    // MÉTODO MÁGICO TOSTRING (Página 13 del PDF)
    // Permite hacer 'print $objeto'. Debe devolver un string.
    public function __toString() {
        $salida = "Incidencia " . $this->puesto . " - " . $this->problema;
        
        if ($this->estado == "Resuelta") {
            $salida .= " - Resuelta: " . $this->resolucion;
        } else {
            $salida .= " - " . $this->estado;
        }
        
        return $salida . "\n"; // Añadimos salto de línea para que se vea bien
    }

    // MÉTODO ESTÁTICO (Página 6 del PDF)
    // Se invoca como Incidencia::getPendientes() sin instanciar la clase.
    public static function getPendientes() {
        return self::$pendientes;
    }
}
?>