<?php
require_once __DIR__ . "../database/Database.php";

class Aprendiz {
    /**
     * Clase modelo para representar un aprendiz de Hogwarts
     * Atributos: nombre, casa, varita, asignaturas, nivel, foto
     * Métodos: __construct, guardar()
    */
    private $nombre;
    private $casa;
    private $varita;
    private $asignaturas;
    private $nivel;
    private $foto;
    

    public function __construct($nombre, $casa, $varita, $asignaturas, $nivel, $foto) {
    /**
    * Inicializa un nuevo aprendiz con los datos proporcionados
    */
        $this->nombre = $nombre;
        $this->casa = $casa;
        $this->varita = $varita;
        $this->asignaturas = $asignaturas;
        $this->nivel = $nivel;
        $this->foto = $foto;
    }

    public function guardar() {
    /**
     * Guarda el aprendiz en la base de datos
     * Devuelve el ID del aprendiz insertado
     */
        try {

            // CREAR TABLA SI NO EXISTE ***

            
            $pdo = new Database()->conectar();

            $sql = "INSERT INTO aprendices (nombre, casa, varita, asignaturas, nivel, foto_registro) 
            VALUES (:nombre, :casa, :varita, :asignaturas, :nivel, :foto_registro)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nombre'   => $this->nombre,
                ':casa'=> $this->casa,
                ':varita'=> $this->varita,
                ':asignatura'=> $this->asignaturas,
                ':nivel'=> $this->nivel,
                ':foto_registro' => $this->foto
            ]);


        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

}
