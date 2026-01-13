<?php
include_once __DIR__ . '/../model/Productes/ProductesDAO.php';
include_once __DIR__ . '/../model/Categoria/CategoriaDAO.php';
class ProductesController
{
    public function Productes()
    {

        $view = 'productes.php';
        require_once dirname(__DIR__) . "/view/plantilla.php";
    }

    // llista de productes
    public function carta()
    {
        // Categories per a filtres
        $categorias = CategoriaDAO::getCategories();

        // Productes visibles a la carta
        $productes = ProductesDAO::getProductesEnCarta();

        // Mapa producte => categories (N:N)
        $ids = array_map(fn($p) => (int)$p->getId(), $productes);
        $mapProducteCategories = ProductesDAO::getCategoriesByProducteIds($ids);

        $view = 'Productes/carta.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    // public function show(){
    //     $view = 'view/show.php';
    //     $idProducte=$_GET['idproducte'];
    //     $producte = ProductesDAO::getProducteByID($idProducte);
    //     include_once __DIR__ . '/../view/main.php';
    // }
    public function index()
    {
        $view = 'view/Productes/index.php';
        $productes = ProductesDAO::getProductes();
        include_once __DIR__ . '/../view/main.php';
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
