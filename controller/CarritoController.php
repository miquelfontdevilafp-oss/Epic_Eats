<?php
include_once __DIR__ . '/../model/Productes/ProductesDAO.php';
include_once __DIR__ . '/../database/DataBase.php';

class CarritoController {
    public function verCarrito() {
        $view = 'carrito/ver.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function checkout() {
        if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }
        $view = 'carrito/checkout.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function confirmacion() {
        // Es mostra després de crear la comanda (requereix sessió)
        if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
            header('Location: ' . BASE_URL . '/?controller=Auth&action=login');
            exit;
        }
        $view = 'carrito/confirmacion.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }
}
