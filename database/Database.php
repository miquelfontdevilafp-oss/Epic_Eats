<?php
class DataBase{
    public static function connect($host='localhost',$user='root',$pass='',$db='epic_eats'){
        $con = new mysqli($host,$user,$pass,$db);

        if ($con == false) {
            die('Error al conectar a la Base de Datos');
        } else {
            return $con;
        }
    }
}
?>