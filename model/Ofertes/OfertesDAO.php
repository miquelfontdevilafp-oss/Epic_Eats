<?php

include_once 'Ofertes.php';
include_once 'database/DataBase.php';

class OfertesDAO{
    public static function getOferteByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ofertes where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Oferte = $results->fetch_object('Ofertes');
        $con->close();
        
        return $Oferte;
    }
    public static function getOfertes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ofertes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaOfertes = [];

        while($Oferte = $results->fetch_object('Ofertes')){
            $listaOfertes[]=$Oferte;
        }
        
        $con->close();
        
        return $listaOfertes;
    }
}

?>