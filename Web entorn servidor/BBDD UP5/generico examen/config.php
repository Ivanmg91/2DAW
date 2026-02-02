<?php
    /**
     * Archivo de configuración de la base de datos.
     * Basado en el ejemplo de Buenas Prácticas de UP5 [cite: 2590-2597].
     */

    // Definición de constantes de conexión (UP5 Pág. 39)
    const HOST = '127.0.0.1';
    const DBNAME = 'EMPRESA'; // Cambia esto por el nombre real de tu base de datos
    const USERNAME = 'dwes';
    const PASSWORD = 'dbdwespass';

    // Opciones del array de PDO (UP5 Pág. 39)
    // ATTR_ERRMODE => ERRMODE_EXCEPTION: Obligatorio para usar try/catch como en los apuntes
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
?>