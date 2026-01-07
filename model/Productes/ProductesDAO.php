<?php

include_once 'Productes.php';
include_once 'database/DataBase.php';

class ProductesDAO{
    public static function getProducteByID($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes where id = ?");
        $stmt-> bind_param('i',$id);
        $stmt->execute();
        $results = $stmt->get_result();
        
        $Producte = $results->fetch_object('Productes');
        $con->close();
        
        return $Producte;
    }
    public static function getProductes(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes");
        $stmt->execute();

        $results = $stmt->get_result();
        
        $listaProductes = [];

        while($Producte = $results->fetch_object('Productes')){
            $listaProductes[]=$Producte;
        }
        
        $con->close();
        
        return $listaProductes;
    }

    /**
     * Productes visibles a la carta (en_carta = 1)
     */
    public static function getProductesEnCarta(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes WHERE en_carta = 1");
        $stmt->execute();

        $results = $stmt->get_result();
        $listaProductes = [];

        while($Producte = $results->fetch_object('Productes')){
            $listaProductes[] = $Producte;
        }

        $con->close();
        return $listaProductes;
    }

    /**
     * Retorna un mapa id_producte => [id_categoria, ...]
     */
    public static function getCategoriesByProducteIds(array $ids): array {
        $ids = array_values(array_filter(array_map('intval', $ids), fn($v) => $v > 0));
        if (empty($ids)) {
            return [];
        }

        $con = DataBase::connect();

        // Construïm placeholders (?,?,?)
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT id_producte, id_categoria FROM productes_categoria WHERE id_producte IN ($placeholders)";
        $stmt = $con->prepare($sql);

        // bind_param dinàmic
        $types = str_repeat('i', count($ids));
        $stmt->bind_param($types, ...$ids);
        $stmt->execute();
        $results = $stmt->get_result();

        $map = [];
        while ($row = $results->fetch_assoc()) {
            $pid = (int)$row['id_producte'];
            $cid = (int)$row['id_categoria'];
            if (!isset($map[$pid])) {
                $map[$pid] = [];
            }
            $map[$pid][] = $cid;
        }

        $stmt->close();
        $con->close();

        return $map;
    }
}

?>