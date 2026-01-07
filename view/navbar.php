<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <!-- Logo Epic Eats + desplegable amb php -->
            <a class="navbar-brand" href="<?= BASE_URL ?>/?controller=Home&action=Home">
                <img src="<?=BASE_URL?>/IMG/Logo_EpicEats_oscuro.png" height="32" alt="EpicEats">
            </a>

            <!-- Menu de pagines -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/?controller=Productes&action=carta">La Nostre Carta</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Restaurant</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reserva</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contacta</a></li>
            </ul>

            <!-- Login/register + carro -->
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item me-2">
                    <a class="nav-link" href="<?= BASE_URL ?>/?controller=Carrito&action=verCarrito">
                        Carrito <span id="contador-carrito" class="badge bg-primary" style="display:none">0</span>
                    </a>
                </li>

                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']): ?>
                    <?php $u = $_SESSION['usuario']; ?>
                    <li class="nav-item">
                        <span class="navbar-text text-white me-2">
                            <?= htmlspecialchars($u->nomUsuari ?? ($u->nom ?? 'Usuari')) ?>
                        </span>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=logout">Sortir</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/?controller=Auth&action=register">Register</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </nav>
</section>


