<?php
class LoginController{
    public function Login(){
        $view = 'Login.php';
        require_once dirname(__DIR__) . "/view/plantilla.php";
    }
}


?>