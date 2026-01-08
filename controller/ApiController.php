<?php
include_once 'controller/UsuariController.php';
include_once 'model/Reserva/ReservaDAO.php';
include_once 'model/Productes/ProductesDAO.php';


class ApiController
{
    public function Api()
    {
        $view = 'admin.php';
        require_once dirname(__DIR__) . "/view/plantilla admin.php";
    }


    public function getUsers()
    {
        try {
            $usuaris = usuariDAO::getUsuaris(); // obtienes objetos

            // Convertir objetos a arrays
            $data = array_map(function ($user) {
                return $user->toArray();
            }, $usuaris);

            echo json_encode([
                'estado' => 'Exito',
                'usuarios' => $data
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Error) {
            echo "'estado' => 'Error'";
        }
    }

    public function getComandes()
    {
        //cridar dao
        //dao retorna json
        //echo del json

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]);
    }

    public function getLinea_Comandes()
    {
        //cridar dao
        //dao retorna json
        //echo del json

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]);
    }

    public function addUser()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $result = usuariDAO::setUsuari(
                $data['nomUsuari'],
                $data['contrasenya'],
                $data['nom'],
                $data['cognoms'],
                $data['correu'],
                $data['telefon'],
                $data['rol']
            );

            if ($result === true) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al inserir"]);
            }
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }


    public function getUserById()
    {
        $id = $_GET['id'];
        $user = usuariDAO::getUsuariByID($id);

        echo json_encode([
            "success" => true,
            "usuario" => $user->toArray()
        ]);
    }

    public static function updateUsuari($id, $nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("UPDATE usuaris SET nomUsuari=?, contrasenya=?, nom=?, cognoms=?, correu=?, telefon=?, rol=? WHERE id=?");
        $stmt->bind_param("sssssssi", $nomUsuari, $contrasenya, $nom, $cognoms, $correu, $telefon, $rol, $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }


    public static function delateUsuari($id)
    {
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM usuaris WHERE id=?");
        $stmt->bind_param("i", $id);

        $ok = $stmt->execute();
        $stmt->close();
        $con->close();

        return $ok;
    }
    public function getReserves()
    {
        try {
            $reserves = reservaDAO::getReserves();
            $data = array_map(function ($r) {
                return [
                    "id" => $r->getId(),
                    "data" => ($r->getData() instanceof DateTime) ? $r->getData()->format("Y-m-d") : $r->getData(),
                    "hora" => ($r->getHora() instanceof DateTime) ? $r->getHora()->format("H:i:s") : $r->getHora(),
                    "numeroPersones" => $r->getNumeroPersones(),
                    "id_usuari" => $r->getId_usuari()
                ];
            }, $reserves);

            echo json_encode(["success" => true, "reserves" => $data], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function getReservaById()
    {
        try {
            $id = (int)($_GET["id"] ?? 0);
            $r = reservaDAO::getReservaByID($id);

            echo json_encode([
                "success" => true,
                "reserva" => [
                    "id" => $r->getId(),
                    "data" => ($r->getData() instanceof DateTime) ? $r->getData()->format("Y-m-d") : $r->getData(),
                    "hora" => ($r->getHora() instanceof DateTime) ? $r->getHora()->format("H:i:s") : $r->getHora(),
                    "numeroPersones" => $r->getNumeroPersones(),
                    "id_usuari" => $r->getId_usuari()
                ]
            ], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function updateReserva()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $ok = reservaDAO::updateReservaDataHora(
                (int)$data["id"],
                $data["data"],
                $data["hora"]
            );

            echo json_encode(["success" => $ok === true]);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
    public function getProductes()
    {
        try {
            $productes = ProductesDAO::getProductes();
            $data = array_map(function ($p) {
                return [
                    "id" => $p->getId(),
                    "nom" => $p->getNom(),
                    "preu_unitat" => $p->getPreuUnitat(),
                    "en_carta" => $p->getEnCarta()
                ];
            }, $productes);

            echo json_encode(["success" => true, "productes" => $data], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function getProducteById()
    {
        try {
            $id = (int)($_GET["id"] ?? 0);
            $p = ProductesDAO::getProducteByID($id);

            echo json_encode([
                "success" => true,
                "producte" => [
                    "id" => $p->getId(),
                    "nom" => $p->getNom(),
                    "preu_unitat" => $p->getPreuUnitat(),
                    "en_carta" => $p->getEnCarta()
                ]
            ], JSON_UNESCAPED_UNICODE);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function updateProductePreu()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $ok = ProductesDAO::updatePreuUnitat(
                (int)$data["id"],
                (float)$data["preu_unitat"]
            );

            echo json_encode(["success" => $ok === true]);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function updateProducte()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $ok = ProductesDAO::updateProducte(
                (int)$data["id"],
                $data["nom"],
                (float)$data["preu_unitat"]
            );

            echo json_encode(["success" => $ok === true]);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
    public function addProducte()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $ok = ProductesDAO::addProducte($data["nom"], (float)$data["preu_unitat"]);
            echo json_encode(["success" => $ok === true]);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function deleteProducte()
    {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $ok = ProductesDAO::deleteProducte((int)$data["id"]);
            echo json_encode(["success" => $ok === true]);
        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}
