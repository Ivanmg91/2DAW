<?php

class Database {
    /**
     * Configuración de la base de datos
     */

    private $host = "192.168.1.200:3306";
    private $db = "ivanM";
    private $usuario = "dwes";
    private $contrasena = "dbdwespass";
    private $charset = "utf8mb4";

    public function conectar() {
        $dsn = "XXX:host={};dbname={};charset={$this->charset}"; // CAMBIAR DATOS ***
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        return new PDO($dsn, $this->usuario, $this->contrasena, $opciones);
    }
}

?>