<?php

include_once __DIR__ . '/entorn.php';

include_once __DIR__ . '/model/Usuari/Usuari.php';

session_start();

include_once __DIR__ . '/controller/HomeController.php';
include_once __DIR__ . '/controller/AdminController.php';
include_once __DIR__ . '/controller/ProductesController.php';
include_once __DIR__ . '/controller/AuthController.php';
include_once __DIR__ . '/controller/CarritoController.php';

$defaultController = 'Home';
$defaultAction = 'Home';

$controllerParam = $_GET['controller'] ?? $defaultController;
$action = $_GET['action'] ?? $defaultAction;

$nombre_controller = ucfirst(strtolower($controllerParam)) . 'Controller';

if (!class_exists($nombre_controller)) {
    http_response_code(404);
    echo '<h1>Controlador no encontrado</h1>';
    exit;
}

$controller = new $nombre_controller();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo '<h1>Acción no encontrada</h1>';
    exit;
}

$controller->$action();
