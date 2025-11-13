<?php

include_once 'model/Categoria/Categoria.php';
include_once 'database/Database.php';

class categoriaDAO{
    public static function getCategoriaByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM categoria where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $categoria = $results->fetch_object('Producte');
        $con->close();
        
        return $categoria;
    }
    public static function getCategories(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM categoria");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaCategories = [];

        while($categoria = $results->fetch_object('Producte')){
            $listaCategories[]=$categoria;
        }
        
        $con->close();
        
        return $listaCategories;
    }
}

?>