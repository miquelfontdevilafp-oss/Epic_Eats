<?php
include_once __DIR__ . '/../model/Productes/ProductesDAO.php';
include_once __DIR__ . '/../database/DataBase.php';

class CarritoController {
    public function verCarrito() {
        $view = 'carrito/ver.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function checkout() {
        $view = 'carrito/checkout.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }

    public function confirmacion() {
        // Es mostra després de crear la comanda
        $view = 'carrito/confirmacion.php';
        require_once __DIR__ . '/../view/plantilla.php';
    }
}
