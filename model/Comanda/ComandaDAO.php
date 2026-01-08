<?php
include_once 'Comanda.php';
include_once 'database/DataBase.php';

class ComandaDAO {

  public static function getComandaByID($id) {
    $con = DataBase::connect();
    $stmt = $con->prepare("SELECT * FROM comanda WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $results = $stmt->get_result();
    $comanda = $results->fetch_object('Comanda');
    $con->close();
    return $comanda;
  }

  public static function getComandes() {
    $con = DataBase::connect();
    $stmt = $con->prepare("SELECT * FROM comanda");
    $stmt->execute();
    $results = $stmt->get_result();

    $lista = [];
    while ($c = $results->fetch_object('Comanda')) {
      $lista[] = $c;
    }
    $con->close();
    return $lista;
  }

  public static function addComanda($preuTotal, $idUsuari) {
    $con = DataBase::connect();
    $stmt = $con->prepare("INSERT INTO comanda (preu_total, id_usuaris) VALUES (?, ?)");
    $stmt->bind_param('di', $preuTotal, $idUsuari);
    $ok = $stmt->execute();
    $con->close();
    return $ok === true;
  }

  public static function updateComanda($id, $preuTotal, $idUsuari) {
    $con = DataBase::connect();
    $stmt = $con->prepare("UPDATE comanda SET preu_total = ?, id_usuaris = ? WHERE id = ?");
    $stmt->bind_param('dii', $preuTotal, $idUsuari, $id);
    $ok = $stmt->execute();
    $con->close();
    return $ok === true;
  }

  public static function deleteComanda($id) {
    $con = DataBase::connect();
    $stmt = $con->prepare("DELETE FROM comanda WHERE id = ?");
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    $con->close();
    return $ok === true;
  }
}
?>
