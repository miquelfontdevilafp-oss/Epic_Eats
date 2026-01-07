<?php

include_once 'Proveidor.php';
include_once 'database/DataBase.php';

class ProveidorDAO{
    public static function getProveidorByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM proveidor where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $proveidor = $results->fetch_object('Proveidor');
        $con->close();
        
        return $proveidor;
    }
    public static function getProveidors(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM proveidor");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProveidors = [];

        while($proveidor = $results->fetch_object('Proveidor')){
            $listaProveidors[]=$proveidor;
        }
        
        $con->close();
        
        return $listaProveidors;
    }
}

?>