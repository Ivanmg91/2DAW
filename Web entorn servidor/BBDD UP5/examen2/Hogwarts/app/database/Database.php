<?php

class Database {
    /**
     * Configuración de la base de datos
     */

    private $host = "192.168.1.200:8000";
    private $db = "ivanM";
    private $usuario = "dwes";
    private $contrasena = "dbdwespass";
    private $charset = "utf8mb4";

    public function conectar() {
        $dsn = "XXX:host={};dbname={};charset={$this->charset}";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        return new PDO($dsn, $this->usuario, $this->contrasena, $opciones);
    }
}

?>