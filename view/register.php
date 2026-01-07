<section class="container py-5" style="max-width: 640px;">
    <h3 class="mb-3">Crear compte</h3>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($_SESSION['flash_error']); ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/?controller=Auth&action=doRegister" class="mt-4">
        <div class="row g-3">
            <div class="mb-3">
                <label class="form-label" for="nomUsuari">Nom d'usuari</label>
                <input
                    type="text"
                    class="form-control"
                    id="nomUsuari"
                    name="nomUsuari"
                    required
                    minlength="3"
                    maxlength="50"
                    autocomplete="username">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input name="nom" type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cognoms</label>
                <input name="cognoms" type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Correu</label>
                <input name="correu" type="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Telèfon</label>
                <input name="telefon" type="text" class="form-control">
            </div>
            <div class="col-md-12">
                <label class="form-label">Contrasenya</label>
                <input name="contrasenya" type="password" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Crear</button>
        <a class="btn btn-outline-secondary mt-4" href="<?= BASE_URL ?>/?controller=Auth&action=login">Tornar</a>
    </form>
</section>