<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <!-- Logo Epic Eats + desplegable amb php -->
            <a class="navbar-brand" href="<?= BASE_URL ?>/?controller=Home&action=Home">
                <img src="<?= BASE_URL ?>/IMG/Logo_EpicEats_oscuro.png" height="32" alt="EpicEats">
            </a>

            <!-- Menu de pagines -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/?controller=Productes&action=carta">La Nostre Carta</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Restaurant</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reserva</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contacta</a></li>
                <?php if (!empty($_SESSION['usuario']) && is_object($_SESSION['usuario'])): ?>
                    <?php $u = $_SESSION['usuario']; ?>
                    <?php if (method_exists($u, 'getRol') && $u->getRol() === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL ?>/?controller=Admin&action=Admin">Admin Panel</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
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
                            <?= htmlspecialchars($u->getNomUsuari(), ENT_QUOTES, 'UTF-8') ?>
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