<?php
class AdminController{
    public function Admin(){
        // Restringim accés a admin (mateix criteri que Proyecto_Restaurante-desarrollo)
        if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }
        $u = $_SESSION['usuario'];
        $rol = null;
        if (is_object($u)) {
            // pot ser Usuari (Epic Eats)
            $rol = $u->getRol() ?? ($u->rol ?? null);
        }
        if ($rol !== 'admin') {
            header('Location: ' . BASE_URL . '/?controller=Home&action=Home');
            exit;
        }
        $view = 'admin.php';
        require_once dirname(__DIR__) . "/view/plantilla admin.php";
    }
}


?>