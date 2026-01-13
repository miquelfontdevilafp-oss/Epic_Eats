<?php
class HomeController{
    public function Home(){
        require_once __DIR__ . '/../model/Productes/ProductesDAO.php';
        require_once __DIR__ . '/../model/Categoria/CategoriaDAO.php';

        // Productes visibles a la carta
        $productes = ProductesDAO::getProductesEnCarta();

        // Categories
        $categorias = CategoriaDAO::getCategories();
        $categoriasById = [];
        foreach ($categorias as $c) {
            $categoriasById[(int)$c->getId()] = (string)$c->getNom();
        }

        // Mapa producte => categories
        $ids = array_map(fn($p) => (int)$p->getId(), $productes);
        $mapProducteCategories = ProductesDAO::getCategoriesByProducteIds($ids);

        // Productes rebaixats
        $productesAmbOferta = ProductesDAO::getProductesEnCartaAmbOferta();
        $rebaixes = array_values(array_filter($productesAmbOferta, function ($row) {
            return !empty($row['oferta_id']);
        }));

        // Seleccions per seccions
        $heroMain = $productes[0] ?? null;
        $heroSecondary = $productes[1] ?? $heroMain;
        $sidebarProducts = array_slice($productes, 1, 6);
        $descobreixProducts = array_slice($productes, 0, 10);
        $rebaixesProducts = array_slice($rebaixes, 0, 3);

        // Categories a la home 
        $filteredCategories = array_values(array_filter($categorias, function ($c) {
            $nom = strtolower(trim((string)($c->getNom() ?? '')));
            return $nom !== 'begudes';
        }));
        $homeCategories = array_slice($filteredCategories, 0, 3);

        $view = 'home.php';
        require_once dirname(__DIR__) . "/view/plantilla.php";
    }
}


?>