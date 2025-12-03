<?php
include_once 'entorn.php';
include_once 'controller/HomeController.php';


$wrong = false;
$wrongMessage = '';

if (isset($_GET['controller'])) {
    $nombre_controller = $_GET['controller'].'Controller';
    if (class_exists($nombre_controller)) {
        $controller = new $nombre_controller();
        $action = $_GET['action'];
        if (isset($_GET['action']) && method_exists($controller, $action)) {
            $controller->$action();
        }else{
            header("Location:404.php");
        }
    } 
}else {
   echo 'Falta el controlador en la URL. Posa-ho FOCA';
    
}
?>