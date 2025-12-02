<?php

include_once 'LineaComandes.php';
include_once 'database\DataBase.php';

class LineaComandesDAO{
    public static function getLineaComandeByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $LineaComanda = $results->fetch_object('LineaComandes');
        $con->close();
        
        return $LineaComanda;
    }
    public static function getLineasComandes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM linea_comandes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaLineasComandes = [];

        while($LineaComanda = $results->fetch_object('LineaComandes')){
            $listaLineasComandes[]=$LineaComanda;
        }
        
        $con->close();
        
        return $listaLineasComandes;
    }
}

?>