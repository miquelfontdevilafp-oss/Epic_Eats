<section class="container py-5 ee-carta">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">Carta</h3>
        <a class="btn btn-outline-primary" href="<?= BASE_URL ?>/?controller=Carrito&action=verCarrito">
            Veure carrito <span id="contador-carrito" class="badge bg-primary" style="display:none">0</span>
        </a>
    </div>

    <div class="row">
        <!-- Filtres (similar a Proyecto_Restaurante-desarrollo, però mantenint CSS/imatges d'Epic Eats) -->
        <aside class="col-12 col-lg-3 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filtres</h5>
                    <p class="text-muted mb-2">Categories</p>

                    <?php if (!empty($categorias ?? [])): ?>
                        <div class="d-grid gap-2" id="filtros-categorias">
                            <?php foreach ($categorias as $c): ?>
                                <label class="form-check">
                                    <input class="form-check-input filtro-categoria" type="checkbox" value="<?= (int)$c->getId() ?>">
                                    <span class="form-check-label"><?= htmlspecialchars((string)$c->getNom(), ENT_QUOTES, 'UTF-8') ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-3" id="btn-limpiar-filtros">Netejar filtres</button>
                    <?php else: ?>
                        <p class="text-muted">No hi ha categories.</p>
                    <?php endif; ?>
                </div>
            </div>
        </aside>

        <!-- Productes -->
        <div class="col-12 col-lg-9">
            <!-- Grid amb espai vertical més ajustat (evita sensació de buits) -->
            <div class="row g-3 ee-carta-grid" id="grid-productes">
                <?php foreach (($productes ?? []) as $p): ?>
            <?php
            // getters (objeto Productes)
            $id   = (int) $p->getId();
            $nom  = (string) ($p->getNom() ?? '');
            $desc = (string) ($p->getDescripcio() ?? '');
            $preu = (float) ($p->getPreuUnitat() ?? 0);
            $img  = (string) ($p->getImatge() ?: 'IMG/ImgNotFound.png');

            $cats = $mapProducteCategories[$id] ?? [];
            $catsAttr = implode(',', array_map('intval', $cats));

            // URL de imagen robusta
            $imgUrl = (str_starts_with($img, 'http') || str_starts_with($img, '/'))
                ? $img
                : (BASE_URL . '/' . ltrim($img, '/'));
            ?>

            <div class="col-md-6 col-xl-4 producto-card" data-categorias="<?= htmlspecialchars($catsAttr, ENT_QUOTES, 'UTF-8') ?>">
                <!-- Sense h-100: cada targeta s'adapta al contingut (imatge + text) -->
                <div class="card">
                    <img
                        src="<?= htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8') ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>"
                        onerror="this.src='<?= BASE_URL ?>/IMG/ImgNotFound.png'">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?></h5>

                        <p class="card-text text-muted">
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
        </div>
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

    // Filtres per categories (client-side)
    const checkboxes = document.querySelectorAll('.filtro-categoria');
    const cards = document.querySelectorAll('.producto-card');

    function aplicarFiltros(){
        const seleccionadas = Array.from(checkboxes)
            .filter(c => c.checked)
            .map(c => parseInt(c.value, 10));

        if (seleccionadas.length === 0) {
            cards.forEach(card => card.style.display = '');
            return;
        }

        cards.forEach(card => {
            const attr = (card.dataset.categorias || '').trim();
            const categorias = attr === '' ? [] : attr.split(',').map(v => parseInt(v, 10)).filter(v => !Number.isNaN(v));
            const match = categorias.some(c => seleccionadas.includes(c));
            card.style.display = match ? '' : 'none';
        });
    }

    checkboxes.forEach(c => c.addEventListener('change', aplicarFiltros));
    const btnLimpiar = document.getElementById('btn-limpiar-filtros');
    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', function(){
            checkboxes.forEach(c => c.checked = false);
            aplicarFiltros();
        });
    }
});
</script>
