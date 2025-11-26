<?php

include_once 'model/Productes/ProductesDAO.php';
include_once 'database/Database.php';

class producteDAO{
    public static function getProducteByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $producte = $results->fetch_object('Productes');
        $con->close();
        
        return $producte;
    }
    public static function getProductes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProductes = [];

        while($producte = $results->fetch_object('Productes')){
            $listaProductes[]=$producte;
        }
        
        $con->close();
        
        return $listaProductes;
    }
}

?>