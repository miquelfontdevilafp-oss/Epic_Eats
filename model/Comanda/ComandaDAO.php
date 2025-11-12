<?php

include_once 'model/Comanda/Comanda.php';
include_once 'database/Database.php';

class comandaDAO{
    public static function getComandaByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM comanda where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $comanda = $results->fetch_object('Comanda');
        $con->close();
        
        return $comanda;
    }
    public static function getComandas(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM comanda");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaComandas = [];

        while($comanda = $results->fetch_object('Comanda')){
            $listaComandas[]=$comanda;
        }
        
        $con->close();
        
        return $listaComandas;
    }
}

?>