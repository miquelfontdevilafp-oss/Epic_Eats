<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>

<section class="container py-5" style="max-width: 820px;">
    <h3 class="mb-3">Comanda confirmada</h3>

    <?php if ($id <= 0): ?>
        <div class="alert alert-warning">No s'ha trobat la comanda.</div>
    <?php else: ?>
        <div class="alert alert-success">
            La teva comanda s'ha creat correctament. <strong>Referència: #<?= htmlspecialchars((string)$id) ?></strong>
        </div>

    <?php endif; ?>

    <a class="btn btn-primary" href="<?= BASE_URL ?>/?controller=Productes&action=carta">Tornar a la carta</a>
</section>