<?php

include_once 'model/Alergans/Alergans.php';
include_once 'database/Database.php';

class alergansDAO{
    public static function getAlerganByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM alergans where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $alergan = $results->fetch_object('Alergans');
        $con->close();
        
        return $alergan;
    }
    public static function getAlergans(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM alergans");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaAlergans = [];

        while($alergan = $results->fetch_object('Alergans')){
            $listaAlergans[]=$alergan;
        }
        
        $con->close();
        
        return $listaAlergans;
    }
}

?>