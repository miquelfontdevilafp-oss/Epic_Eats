<?php
class AdminController{
    public function Admin(){
        $view = 'admin.php';
        require_once dirname(__DIR__) . "/view/plantilla admin.php";
    }
}


?>