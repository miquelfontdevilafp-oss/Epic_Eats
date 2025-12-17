<?php
class ProductesController{
    public function Productes(){

        $view = 'productes.php';
        require_once __DIR__ . "\..\\view\plantilla.php";
    }
    public function show(){
        $view = 'view/Usuari/show.php';
        $idProducte=$_GET['idproducte'];
        $producte = ProductesDAO::getProducteByID($idProducte);
        include_once 'view/main.php';
    }
    public function index(){
        $view = 'view/Usuari/index.php';
        $productes = ProductesDAO::getProductes();
        include_once 'view/main.php';
    }
    // public function getUsuaris(){
    //     $usuaris = UsuariDAO::getUsuaris();
    //     return $usuaris;
    // }
    // public function getUsuariByID($idProducte){
    //     $usuari = UsuariDAO::getUsuariByID($idProducte);
    //     return $usuari;
    // }
    // public function setUsuari($nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol){
    //     $setUsuari = usuariDAO::setUsuari($nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol);
    // }
}


?>