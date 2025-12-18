<?php
include_once 'entorn.php';
include_once 'controller/HomeController.php';
include_once 'controller/AdminController.php';
include_once 'controller/LoginController.php';
include_once 'controller/ApiController.php';
include_once 'controller/ProductesController.php';



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
    }else {
        echo 'No existe controlador '.$nombre_controller;
    } 
}else {
   echo 'Falta el controlador en la URL. Posa-ho FOCA';
}


?>