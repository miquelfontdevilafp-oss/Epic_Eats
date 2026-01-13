<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/IMG/Logo_EpicEats_oscuro.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href= "<?= BASE_URL ?>/CSS/epicEats.css">
    <title>Epic Eats</title>
</head>
<header class="header">
    <?php 
    include_once __DIR__ . '/navbar.php'; 
    ?> 
</header>
<body>
    <main>
        <section>
            
           <?php include_once __DIR__ . '/' . $view; ?>
        </section>
    </main>
    <script src="<?= BASE_URL ?>/JS/carrito.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include_once __DIR__ . '/footer.php'; ?>
</html>