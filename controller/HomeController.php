<?php
class HomeController{
    public function Home(){

        $view = 'home.php';
        require_once __DIR__ . "\..\\view\plantilla.php";
    }
}


?>