<?php

include_once 'Productes.php';
include_once 'database/DataBase.php';

class ProductesDAO
{
    public static function getProducteByID($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes where id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $results = $stmt->get_result();

        $Producte = $results->fetch_object('Productes');
        $con->close();

        return $Producte;
    }
    public static function getProductes()
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes");
        $stmt->execute();

        $results = $stmt->get_result();

        $listaProductes = [];

        while ($Producte = $results->fetch_object('Productes')) {
            $listaProductes[] = $Producte;
        }

        $con->close();

        return $listaProductes;
    }

    /**
     * Productes visibles a la carta (en_carta = 1)
     */
    public static function getProductesEnCarta()
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM productes WHERE en_carta = 1");
        $stmt->execute();

        $results = $stmt->get_result();
        $listaProductes = [];

        while ($Producte = $results->fetch_object('Productes')) {
            $listaProductes[] = $Producte;
        }

        $con->close();
        return $listaProductes;
    }

    /**
     * Retorna un mapa id_producte => [id_categoria, ...]
     */
    public static function getCategoriesByProducteIds(array $ids): array
    {
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
    public static function updatePreuUnitat(int $id, float $preu): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE productes SET preu_unitat = ? WHERE id = ?");
        $stmt->bind_param("di", $preu, $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }
    public static function updateProducte(int $id, string $nom, float $preu): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE productes SET nom = ?, preu_unitat = ? WHERE id = ?");
        $stmt->bind_param("sdi", $nom, $preu, $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }
    public static function addProducte(string $nom, float $preu): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO productes (nom, preu_unitat) VALUES (?, ?)");
        $stmt->bind_param("sd", $nom, $preu);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }

    public static function deleteProducte(int $id): bool
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM productes WHERE id = ?");
        $stmt->bind_param("i", $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }
    public static function getProductesEnCartaAmbOferta()
    {
        $con = DataBase::connect();

        $sql = "
        SELECT 
            p.*,
            o.id AS oferta_id,
            o.nom AS oferta_nom,
            o.tipus AS oferta_tipus,
            o.valordescompte,
            o.persentatjedescompte,
            CASE
                WHEN o.id IS NULL THEN p.preu_unitat
                WHEN o.tipus = 'valor' THEN GREATEST(p.preu_unitat - o.valordescompte, 0)
                WHEN o.tipus = 'percentatge' THEN ROUND(p.preu_unitat * (1 - (o.persentatjedescompte / 100)), 2)
                ELSE p.preu_unitat
            END AS preu_final
        FROM productes p
        LEFT JOIN productes_ofertes po ON po.id_producte = p.id
        LEFT JOIN ofertes o 
            ON o.id = po.id_oferta
            AND NOW() BETWEEN o.datainici AND o.datafi
        WHERE p.en_carta = 1
    ";

        $stmt = $con->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();

        $lista = [];
        while ($row = $results->fetch_assoc()) {
            $lista[] = $row; // aquí devuelves array para incluir preu_final
        }

        $stmt->close();
        $con->close();
        return $lista;
    }
}
