<?php

include_once 'model/Ofertes/Ofertes.php';
include_once 'database/Database.php';

class ofertaDAO{
    public static function getOfertaByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ofertes where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $oferta = $results->fetch_object('Ofertes');
        $con->close();
        
        return $oferta;
    }
    public static function getOfertes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ofertes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaOfertes = [];

        while($oferta = $results->fetch_object('Ofertes')){
            $listaOfertes[]=$oferta;
        }
        
        $con->close();
        
        return $listaOfertes;
    }
}

?>