<?php
function connectDB() : mysqli{
    $db = new mysqli('mariadb', 'prueba_web', '123456', 'prueba');

    if($db->connect_errno){
        echo "Error al conectar a la base de datos: " . $db->connect_error;
        exit; // Se detiene la ejecución del código
    }

    // Establecer el conjunto de caracteres a UTF-8
    $db->set_charset('utf8');

    return $db;
}
