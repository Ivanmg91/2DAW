<?php
trait DniTrait {

    public function generarDNI() {
        $numero = rand(10000000, 99999999);
        $resto = $numero % 23;
        
        $letra = $this->generaLetraDNI($resto);
        
        return $numero . $letra;
    }

    private function generaLetraDNI($idLetra) {
        $letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
        return $letras[$idLetra];
    }
}
?>