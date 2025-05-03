<?php

function conectarDB() : mysqli {
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    );

    if($db->connect_error){
        echo 'Error: No se pudo conectar - ' . $db->connect_error;
        exit;
    }

    return $db;
}