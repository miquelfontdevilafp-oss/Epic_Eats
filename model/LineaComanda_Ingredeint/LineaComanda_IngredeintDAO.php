<?php

include_once 'model/LineaComanda_Ingredeint/LineaComanda_Ingredeint.php';
include_once 'database/Database.php';

class lineaComanda_IngredeintDAO{
    public static function getLineaComanda_IngredeintByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes__ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $lineaComanda_Ingredeint = $results->fetch_object('LineaComanda_Ingredeint');
        $con->close();
        
        return $lineaComanda_Ingredeint;
    }
    public static function getLineasComandes_Ingredeints(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes__ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        $listaLineasComandes_Ingredeints = [];
        while($lineaComanda_Ingredeint = $results->fetch_object('LineaComanda_Ingredeint')){
            $listaLineasComandes_Ingredeints[]=$lineaComanda_Ingredeint;
        }
        
        $con->close();
        
        return $listaLineasComandes_Ingredeints;
    }
}

?>