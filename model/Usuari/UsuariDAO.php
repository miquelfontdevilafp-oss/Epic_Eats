<?php

include_once 'Usuari.php';
include_once 'database/DataBase.php';

class usuariDAO
{
    public static function getUsuariByID($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();

        $usuari = $results->fetch_object('Usuari');
        $con->close();

        return $usuari;
    }
    public static function getUsuaris()
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris");
        $stmt->execute();

        $results = $stmt->get_result();

        $listaUsuaris = [];

        while ($usuari = $results->fetch_object('Usuari')) {
            $listaUsuaris[] = $usuari;
        }

        $con->close();

        return $listaUsuaris;
    }
    public static function getUsuariByCorreu($correu)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris where correu = ?");
        $stmt->bind_param('s', $correu);
        $stmt->execute();
        $results = $stmt->get_result();

        $usuari = $results->fetch_object('Usuari');
        $con->close();

        return $usuari;
    }

    public static function getUsuariByUserName($userName)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM usuaris where nomUsuari = ?");
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $results = $stmt->get_result();

        $usuari = $results->fetch_object('Usuari');
        $con->close();

        return $usuari;
    }

    public static function setUsuari($nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol)
    {
        // Ajusta límites para bcrypt y coherente con tu tabla
        if (strlen($nomUsuari) > 50 || strlen($contrasenya) > 255 || strlen($nom) > 50 || strlen($cognoms) > 50 || strlen($correu) > 50 || strlen($telefon) > 9 || strlen($rol) > 50) {
            return null;
        }

        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO usuaris (nomUsuari, contrasenya, nom, cognoms, correu, telefon, rol)
                           VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            // debug temporal:
            // die("Prepare failed: " . $con->error);
            $con->close();
            return null;
        }

        $stmt->bind_param('sssssss', $nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol);

        $ok = $stmt->execute();
        if (!$ok) {
            // debug temporal:
            // die("Execute failed: " . $stmt->error);
            $stmt->close();
            $con->close();
            return null;
        }

        $newId = $con->insert_id;

        $stmt->close();
        $con->close();

        return $newId;
    }


    public static function updateUsuari($id, $nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE usuaris SET nomUsuari=?, contrasenya=?, nom=?, cognoms=?, correu=?, telefon=?, rol=? WHERE id=?");
        $stmt->bind_param("sssssssi", $nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol, $id);
        $stmt->execute();
        $results = $stmt->get_result();
        $con->close();
        return $results;
    }


    public static function delateUsuari($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM usuaris WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->get_result();
        $con->close();
        return $results;
    }

    public static function getUsuarisJSON()
    {
        $usuaris = self::getUsuaris(); // obtienes objetos Usuari
        $data = [];
        foreach ($usuaris as $user) {
            $data[] = $user->toArray(); // los conviertes a arrays
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
