<?php

include_once 'Comanda.php';
include_once 'database/DataBase.php';

class ComandaDAO{
    public static function getComandaByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Comanda = $results->fetch_object('Comanda');
        $con->close();
        
        return $Comanda;
    }
    public static function getComandes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM ingredients");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaComandes = [];

        while($Comanda = $results->fetch_object('Comanda')){
            $listaComandes[]=$Comanda;
        }
        
        $con->close();
        
        return $listaComandes;
    }
}

?>