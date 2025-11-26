<?php

include_once 'model/Productes_ingredients/Productes_ingredients.php';
include_once 'database/Database.php';

class Productes_ingredientsDAO{
    public static function getProductes_ingredientsByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM Productes_ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Productes_ingredients = $results->fetch_object('Productes_ingredients');
        $con->close();
        
        return $Productes_ingredients;
    }
    public static function getProductes_ingredients(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM Productes_ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProductes_ingredients = [];

        while($Productes_ingredients = $results->fetch_object('Productes_ingredients')){
            $listaProductes_ingredients[]=$Productes_ingredients;
        }
        
        $con->close();
        
        return $listaProductes_ingredients;
    }
}

?>