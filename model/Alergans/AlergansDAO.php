<?php

include_once 'Alergans.php';
include_once 'database\DataBase.php';

class AlerganDAO{
    public static function getAlerganByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Alergan = $results->fetch_object('Alergans');
        $con->close();
        
        return $Alergan;
    }
    public static function getAlergans(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaAlergans = [];

        while($Alergan = $results->fetch_object('Alergans')){
            $listaAlergans[]=$Alergan;
        }
        
        $con->close();
        
        return $listaAlergans;
    }
}

?>