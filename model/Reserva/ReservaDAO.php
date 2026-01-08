<?php

include_once 'Reserva.php';
include_once 'database/DataBase.php';

class reservaDAO
{
    public static function getReservaByID($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM reserva where id = ?");
        //si tenim mes camps podem fer aixo $stmt-> bind_param('iis',$id, $int2, $string);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();

        $reserva = $results->fetch_object('Reserva');
        $con->close();

        return $reserva;
    }
    public static function getReserves()
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM reserva");
        $stmt->execute();

        $results = $stmt->get_result();

        $listaReserves = [];

        while ($reserva = $results->fetch_object('Reserva')) {
            $listaReserves[] = $reserva;
        }

        $con->close();

        return $listaReserves;
    }
    public static function updateReservaDataHora(int $id, string $data, string $hora): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE reserva SET data = ?, hora = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data, $hora, $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }
}
