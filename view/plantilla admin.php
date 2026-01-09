<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inter (global font) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Base theme (shared with the public site) -->
    <link rel="stylesheet" href= "<?= BASE_URL ?>/CSS/epicEats.css">
    <link rel="stylesheet" href= "<?= BASE_URL ?>/CSS/adminPanel.css">
    <title>Admin Panel Epic Eats</title>
</head>
<header class="header">

</header>
<body>
    <main>
        <?php include_once $view; ?>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/AdminPanel.js"></script>
</body>
</html>