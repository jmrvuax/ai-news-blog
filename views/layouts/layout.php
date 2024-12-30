<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <?php include 'views/layouts/header.php'; ?>
    <main>
        <?php echo $content; ?>
    </main>
    <?php include 'views/layouts/footer.php'; ?>
    <script src="/js/scripts.js"></script>
    <?php
    if (isset($scripts)) {
        foreach ($scripts as $script) {
            echo '<script src="' . htmlspecialchars($script) . '" defer></script>';
        }
    }
    ?>
</body>
</html>