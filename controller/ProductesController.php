<?php
include_once 'model/Productes/ProductesDAO.php';
class ProductesController
{
    public function Productes()
    {

        $view = 'productes.php';
        require_once dirname(__DIR__) . "/view/plantilla.php";
    }

    // Carta tipus "Proyecto_Restaurante-desarrollo": llista de productes amb botó d'afegir al carrito
    public function carta()
    {
        $productes = ProductesDAO::getProductes();
        $view = 'Productes/carta.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    // public function show(){
    //     $view = 'view/show.php';
    //     $idProducte=$_GET['idproducte'];
    //     $producte = ProductesDAO::getProducteByID($idProducte);
    //     include_once 'view/main.php';
    // }
    public function index()
    {
        $view = 'view/Productes/index.php';
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
