<?php
include_once 'controller/UsuariController.php';

class ApiController{
    public function Api(){
        $view = 'admin.php';
        require_once dirname(__DIR__) . "/view/plantilla admin.php";
    }


    public function getUsers(){
        try{
            $usuaris = usuariDAO::getUsuaris(); // obtienes objetos

            // Convertir objetos a arrays
            $data = array_map(function($user) {
                return $user->toArray();
            }, $usuaris);

            echo json_encode([
                'estado' => 'Exito',
                'usuarios' => $data
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Error){
            echo "'estado' => 'Error'";
        }
    }

    public function getComandes(){
        //cridar dao
        //dao retorna json
        //echo del json

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]); 

    }

    public function getLinea_Comandes(){
        //cridar dao
        //dao retorna json
        //echo del json

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]); 

    }
    
    public function addUser() {
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

            if ($result !== null) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al inserir"]);
            }

        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }

    
    public function getUserById() {
        $id = $_GET['id'];
        $user = usuariDAO::getUsuariByID($id);
        
        echo json_encode([
            "success" => true,
            "usuario" => $user->toArray()
        ]);
    }
    //TODO fer la part en el controllador
    public function updateUser() {
        $data = json_decode(file_get_contents("php://input"), true);

        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $result = usuariDAO::updateUsuari($data['id'], $data['nomUsuari'], $data['contrasenya'], $data['nom'], $data['cognoms'], $data['correu'], $data['telefon'], $data['rol']);

            if ($result !== null) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al inserir"]);
            }

        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
    
    public function deleteUser() {
        // $data = json_decode(file_get_contents("php://input"), true);

        try {
            $data = json_decode(file_get_contents("php://input"), true);

            $result = usuariDAO::delateUsuari($data['id']);

            if ($result !== null) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al inserir"]);
            }

        } catch (Throwable $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}
    
?>