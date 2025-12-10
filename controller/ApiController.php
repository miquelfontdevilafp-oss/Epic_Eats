<?php
class ApiController{
    public function Api(){
        $view = 'admin.php';
        require_once __DIR__ . "\..\\view\plantilla admin.php";
    }


    public function getUsers(){
        //cridar dao
        //dao retorna json
        //echo del json

        echo json_encode([
            'estado' => 'Exito',
            'data' => 'Insertado correctamente'
        ]); 

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