<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
        <h1>Welcome to AI News</h1>
    </header>
    <main>
        <section>
            <h2>Latest Articles</h2>
            <ul>
                <?php foreach ($articles as $article): ?>
                    <li><?php echo htmlspecialchars($article['title']); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 AI News Blog</p>
    </footer>
</body>
</html>