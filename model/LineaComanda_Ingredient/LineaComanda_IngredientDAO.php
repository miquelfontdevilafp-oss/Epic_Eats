<?php

include_once 'LineaComanda_Ingredient.php';
include_once 'database\DataBase.php';

class LineaComanda_IngredientDAO{
    public static function getLineaComanda_IngredientByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes__ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $LineaComanda_Ingredient = $results->fetch_object('LineaComanda_Ingredient');
        $con->close();
        
        return $LineaComanda_Ingredient;
    }
    public static function getLineasComandesIngredients(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes__ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaLineasComandesIngredients = [];

        while($LineaComanda_Ingredient = $results->fetch_object('LineaComanda_Ingredient')){
            $listaLineasComandesIngredients[]=$LineaComanda_Ingredient;
        }
        
        $con->close();
        
        return $listaLineasComandesIngredients;
    }
}

?>