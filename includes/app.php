<?php 

require __DIR__.'/../vendor/autoload.php';
require 'funciones.php';
require 'config/database.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config');
$dotenv->load();

//Conectar la base de datos
$db = conectarDB();

use Model\activeRecord;

activeRecord::setDB($db);
