<?php

include_once 'model/Linea_Comandes/LineaComandes.php';
include_once 'database/Database.php';

class lineaComandaDAO{
    public static function getLineaComandaByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $lineaComanda = $results->fetch_object('LineaComandes');
        $con->close();
        
        return $lineaComanda;
    }
    public static function getLineaComandes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaLineaComandes = [];

        while($lineaComanda = $results->fetch_object('LineaComandes')){
            $listaLineaComandes[]=$lineaComanda;
        }
        
        $con->close();
        
        return $listaLineaComandes;
    }
}

?>