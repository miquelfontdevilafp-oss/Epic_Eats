<?php

include_once 'Categoria.php';
include_once 'database/DataBase.php';

class CategoriaDAO{
    public static function getCategoriaByID($id){
        $con = DataBase::connect();
        // Epic Eats DB: taula `categoria`
        $stmt = $con->prepare("SELECT * FROM categoria WHERE id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Categoria = $results->fetch_object('Categoria');
        $con->close();
        
        return $Categoria;
    }
    public static function getCategories(){
        $con = DataBase::connect();
        // Epic Eats DB: taula `categoria`
        $stmt = $con->prepare("SELECT * FROM categoria ORDER BY nom");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaCategories = [];

        while($Categoria = $results->fetch_object('Categoria')){
            $listaCategories[]=$Categoria;
        }
        
        $con->close();
        
        return $listaCategories;
    }
}

?>