<?php
include_once 'model\Usuari\UsuariDAO.php';
class UsuariController{
    public function show(){
        $view = 'view/Usuari/show.php';
        $idUsuari=$_GET['idusuari'];
        $usuari = UsuariDAO::getUsuariByID($idUsuari);
        include_once 'view/main.php';
    }
    public function index(){
        $view = 'view/Usuari/index.php';
        $usuaris = UsuariDAO::getUsuaris();
        include_once 'view/main.php';
    }
    public function getUsuaris(){
        $usuaris = UsuariDAO::getUsuaris();
        return $usuaris;
    }
    public function getUsuariByID($idUsuari){
        $usuari = UsuariDAO::getUsuariByID($idUsuari);
        return $usuari;
    }
}