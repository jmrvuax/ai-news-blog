<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            echo '<script src="' . htmlspecialchars($script) . '"></script>';
        }
    }
    ?>
</body>
</html>