<?php

include_once 'Productes.php';
include_once 'database\DataBase.php';

class ProductesDAO{
    public static function getProducteByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes where id = ?");
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Producte = $results->fetch_object('Productes');
        $con->close();
        
        return $Producte;
    }
    public static function getProductes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProductes = [];

        while($Producte = $results->fetch_object('Productes')){
            $listaProductes[]=$Producte;
        }
        
        $con->close();
        
        return $listaProductes;
    }
}

?>