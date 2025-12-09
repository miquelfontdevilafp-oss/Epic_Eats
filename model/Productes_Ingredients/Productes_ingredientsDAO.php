<?php

include_once 'Productes_ingredients.php';
include_once 'database\DataBase.php';

class Productes_ingredientDAO{
    public static function getProducte_ingredientsByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes_ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Producte_ingredient = $results->fetch_object('Productes_ingredients');
        $con->close();
        
        return $Producte_ingredient;
    }
    public static function getProductes_ingredients(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes_ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProductes_ingredients = [];

        while($Producte_ingredient = $results->fetch_object('Productes_ingredients')){
            $listaProductes_ingredients[]=$Producte_ingredient;
        }
        
        $con->close();
        
        return $listaProductes_ingredients;
    }
}

?>