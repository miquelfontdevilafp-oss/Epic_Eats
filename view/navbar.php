<?php
$u = $_SESSION['usuario'] ?? null;
?>

<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ee-navbar">
        <div class="container-fluid">

            <!-- Brand (logo + STORE) -->
            <a class="navbar-brand ee-brand" href="<?= BASE_URL ?>/?controller=Home&action=Home">
                <!-- Epic Eats logo + STORE (avoid duplicate "STORE" inside the image) -->
                <img class="ee-brand-logo" src="<?= BASE_URL ?>/IMG/Logo_EpicEats_Claro.svg" alt="Epic Eats">
                <span class="ee-brand-text">STORE</span>
            </a>

            <!-- Botó col·lapse (mòbil) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#eeNavbar"
                    aria-controls="eeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="eeNavbar">

                <!-- Menu de pàgines -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/?controller=Productes&action=carta">La Nostre Carta</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Restaurant</a></li>
                    <li class="nav-item">
                        <!-- Deshabilitado -->
                        <a class="nav-link ee-disabled-link" href="#" aria-disabled="true" tabindex="-1">Reserva</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacta</a></li>

                    <?php if ($u && $u->getRol() === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= BASE_URL ?>/?controller=Admin&action=Admin">AdminPanel</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Carro + Login/Register -->
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item me-lg-2">
                        <a class="nav-link ee-cart" href="<?= BASE_URL ?>/?controller=Carrito&action=verCarrito">
                            <span class="ee-cart-text">Carro</span>
                            <svg class="svg20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M7 7H21L20 13H8L7 7Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                                <path d="M7 7L6.3 4.5H3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M8.5 20a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="currentColor"/>
                                <path d="M18 20a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" fill="currentColor"/>
                            </svg>
                            <span id="contador-carrito" class="badge bg-primary" style="display:none">0</span>
                        </a>
                    </li>

                    <?php if ($u): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white-50 me-lg-2">
                                <?= htmlspecialchars($u->getNomUsuari(), ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=logout">Sortir</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=register">Registrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=login">Inicia sessió</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
