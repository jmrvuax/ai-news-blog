<!--
HTML Structure:
1. <!DOCTYPE html> - Defines the document as HTML5.
2. <html lang="en"> - Root element, specifying the language.
3. <head> - Contains metadata, like title and viewport settings.
4. <meta charset="UTF-8"> - Sets character encoding to UTF-8.
5. <meta name="viewport" content="width=device-width, initial-scale=1.0"> - Ensures responsiveness on mobile.
6. <title> - Sets the page title in the browser tab.
7. <body> - Contains all visible content.
8. <header> - Holds introductory content, like navigation.
9. <main> - Wraps the main content of the page.
10. <section> - Represents a standalone section of content.
11. <ul> and <li> - Define an unordered list and list items.
12. <footer> - Contains footer information, typically at the bottom.
-->

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