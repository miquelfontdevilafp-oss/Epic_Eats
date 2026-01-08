<?php
class HomeController{
    public function Home(){

        // Productes dinàmics per a la Home
        // - Prioritza productes visibles a la carta
        // - Inclou preu_final si hi ha oferta activa
        require_once dirname(__DIR__) . '/model/Productes/ProductesDAO.php';

        $productesHome = ProductesDAO::getProductesEnCartaAmbOferta();

        // Fallback si el mètode amb oferta retorna buit (o si no hi ha taules d'ofertes configurades)
        if (empty($productesHome)) {
            $objs = ProductesDAO::getProductesEnCarta();
            $productesHome = array_map(function ($p) {
                return [
                    'id' => $p->getId(),
                    'nom' => $p->getNom(),
                    'descripcio' => $p->getDescripcio(),
                    'preu_unitat' => $p->getPreuUnitat(),
                    'preu_final' => $p->getPreuUnitat(),
                    'imatge' => $p->getImatge(),
                    'en_carta' => $p->getEnCarta(),
                ];
            }, $objs);
        }

        // Blocs que consumeix la vista
        $homeHero = $productesHome[0] ?? null;
        $homeSidebar = array_slice($productesHome, 1, 5);
        $homeDescobreix = array_slice($productesHome, 0, 5);

        // Rebaixes: prioritzem productes amb oferta activa
        $homeRebaixes = array_values(array_filter($productesHome, function ($p) {
            return isset($p['oferta_id']) && !empty($p['oferta_id']);
        }));
        if (empty($homeRebaixes)) {
            $homeRebaixes = array_slice($productesHome, 0, 3);
        } else {
            $homeRebaixes = array_slice($homeRebaixes, 0, 3);
        }

        $view = 'home.php';
        require_once dirname(__DIR__) . "/view/plantilla.php";
    }
}


?>