<?php
include_once 'model/Usuari/UsuariDAO.php';
class UsuariController{
    public function show(){
        $view = 'view/usuari/show.php';
        $idusuari=$_GET['idusuari'];
        $usuari = UsuariDAO::getUsuariByID($idusuari);
        include_once 'view/main.php';
    }
    public function index(){
        $view = 'view/usuari/index.php';
        $usuaris = UsuariDAO::getUsuaris();
        include_once 'view/main.php';
    }
}