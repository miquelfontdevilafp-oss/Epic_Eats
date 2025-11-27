<?php

include_once 'controller/UsuariController.php';

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
    } else{
        $wrong = true;
        $wrongMessage = $wrongMessage.'classe no existeix<hr>';
    }
} else{
    $wrong = true;
    $wrongMessage = $wrongMessage.'controllador no existeix<hr>';
}
if ($wrong == true) {
    echo"<hr>Errores: <br> $wrongMessage";
}
?>