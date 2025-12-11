<?php
include_once 'controller/UsuariController.php';

class ApiController{
    public function Api(){
        $view = 'admin.php';
        require_once __DIR__ . "\..\\view\plantilla admin.php";
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
}


?>