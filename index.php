<?php
require_once 'vendor/autoload.php';
require_once 'model/DB/Connection.php';
session_start();

$controller = 'Session';
$action;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Todo esta lógica hara el papel de un FrontController
if(isset($_SESSION['user'])) {
    $action = 'welcome';
} else {
    $action = 'index';
}

if(!isset($_REQUEST['c']))
{
    $controller = ucwords($controller);
    require_once "controller/$controller.php";
    $controller = new $controller;
} else {
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_GET['c']);
    $action = isset($_GET['a']) ? $_GET['a'] : 'index';
    
    // Instanciamos el controlador
    $controller = ucwords($controller);
    require_once "controller/$controller.php";
    $controller = new $controller;
    
}

// Llama la accion
call_user_func( array( $controller, $action ) );