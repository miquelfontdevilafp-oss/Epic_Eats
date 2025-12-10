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
    public static function getUsuariByUserName($correu){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris where correu = ?");
        $stmt-> bind_param('s',$correu);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $usuari = $results->fetch_object('Usuari');
        $con->close();
        
        return $usuari;
    }

    public static function setUsuari($nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol){
        if (strlen($nomUsuari) > 20 || strlen($contrasenya) > 20 || strlen($nom) > 50 || strlen($cognoms) > 50 || strlen($correu) > 50 || strlen($telefon) > 9 || strlen($rol) > 50) {
            return "Algun del valors introduits soperen el maxim nombre de valors\n
            Nom del usuari max 20\n
            contrasenya max 20 \n
            nom max 50 \n
            cognom max 50 \n
            correu max 50 \n
            telefon sense +34 max 9 \n
            rol max 50";
        } else{
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO usuaris (nomUsuari, contrasenya, nom, cognoms, correu, telefon, rol) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt-> bind_param('sssssss',$nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $missatge = $results;
        $con->close();
        
        return $missatge;
        }
        
    }
}

?>