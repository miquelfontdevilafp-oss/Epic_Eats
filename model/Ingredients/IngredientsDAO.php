<?php

include_once 'IngredientsDAO.php';
include_once 'database\DataBase.php';

class IngredientsDAO{
    public static function getIngredientByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Ingredient = $results->fetch_object('Ingredients');
        $con->close();
        
        return $Ingredient;
    }
    public static function getIngredients(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaIngredients = [];

        while($ingredient = $results->fetch_object('Ingredients')){
            $listaIngredients[]=$ingredient;
        }
        
        $con->close();
        
        return $listaIngredients;
    }
}

?>