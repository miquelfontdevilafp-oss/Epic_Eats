<?php

include_once 'model/Usuari/Usuari.php';
include_once 'database/Database.php';

class UsuariDAO {

    public static function getUsuariByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris WHERE id = ?"); //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();

        $row = $results->fetch_assoc();
        $con->close();

        if (!$row) return null;

        return new Usuari(
            $row["id"],
            $row["nomUsuari"],
            $row["contrasenya"],
            $row["nom"],
            $row["cognoms"],
            $row["correu"],
            $row["telefon"],
            $row["rol"]
        );
    }

    public static function getUsuaris(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris");
        $stmt->execute();
        $results = $stmt->get_result();

        $listaUsuaris = [];

        while($row = $results->fetch_assoc()){
            $listaUsuaris[] = new Usuari(
                $row["id"],
                $row["nomUsuari"],
                $row["contrasenya"],
                $row["nom"],
                $row["cognoms"],
                $row["correu"],
                $row["telefon"],
                $row["rol"]
            );
        }

        $con->close();
        return $listaUsuaris;
    }
}

?>
