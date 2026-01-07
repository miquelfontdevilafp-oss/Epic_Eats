<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Carta</h3>
        <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/?controller=Carrito&action=verCarrito">
            Veure carrito <span id="contador-carrito" class="badge bg-primary" style="display:none">0</span>
        </a>
    </div>

    <div class="row g-4">
        <?php foreach (($productes ?? []) as $p): ?>
            <?php
            // getters (objeto Productes)
            $id   = (int) $p->getId();
            $nom  = (string) ($p->getNom() ?? '');
            $desc = (string) ($p->getDescripcio() ?? '');
            $preu = (float) ($p->getPreuUnitat() ?? 0);
            $img  = (string) ($p->getImatge() ?: 'IMG/ImgNotFound.png');

            // URL de imagen robusta
            $imgUrl = (str_starts_with($img, 'http') || str_starts_with($img, '/'))
                ? $img
                : (BASE_URL . '/' . ltrim($img, '/'));
            ?>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <img
                        src="<?= htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8') ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>"
                        onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?></h5>

                        <p class="card-text text-muted" style="flex:1">
                            <?= htmlspecialchars($desc, ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <div class="d-flex justify-content-between align-items-center">
                            <strong><?= number_format($preu, 2) ?> €</strong>

                            <button
                                type="button"
                                class="btn btn-primary btn-add-carrito"
                                data-id="<?= (int)$id ?>"
                                data-nom='<?= htmlspecialchars($nom, ENT_QUOTES, "UTF-8") ?>'
                                data-preu="<?= (float)$preu ?>"
                                data-img='<?= htmlspecialchars($img, ENT_QUOTES, "UTF-8") ?>'>
                                Afegir
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // contador (si existe)
    if (typeof actualizarContadorCarrito === 'function') {
        actualizarContadorCarrito();
    }

    // listeners a botones
    document.querySelectorAll('.btn-add-carrito').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = parseInt(this.dataset.id, 10);
            const nom = this.dataset.nom || '';
            const preu = parseFloat(this.dataset.preu || '0');
            const img = this.dataset.img || 'IMG/ImgNotFound.png';

            if (typeof anadirAlCarrito !== 'function') {
                console.error('anadirAlCarrito no está definido. Revisa la carga de /JS/carrito.js');
                return;
            }

            anadirAlCarrito(id, nom, preu, img, 1);
        });
    });
});
</script>
