<?php

include_once 'Usuari.php';
include_once 'database\DataBase.php';

class usuariDAO{
    public static function getUsuariByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $usuari = $results->fetch_object('Usuari');
        $con->close();
        
        return $usuari;
    }
    public static function getUsuaris(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaUsuaris = [];

        while($usuari = $results->fetch_object('Usuari')){
            $listaUsuaris[]=$usuari;
        }
        
        $con->close();
        
        return $listaUsuaris;
    }
}

?>