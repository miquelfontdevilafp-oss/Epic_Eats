<section class="container py-5" style="max-width: 520px;">
    <h3 class="mb-3">Iniciar sessió</h3>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($_SESSION['flash_error']); ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <p class="text-muted">Accedeix amb el teu correu i contrasenya.</p>

    <form method="POST" action="<?= BASE_URL ?>/?controller=Auth&action=doLogin" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Correu</label>
            <input name="correu" type="email" class="form-control" placeholder="correu@example.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contrasenya</label>
            <input name="contrasenya" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>

    <div class="mt-3">
        <span class="text-muted">No tens compte?</span>
        <a href="<?= BASE_URL ?>/?controller=Auth&action=register">Crear un compte</a>
    </div>
</section>
