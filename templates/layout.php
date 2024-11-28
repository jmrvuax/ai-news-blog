<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title><?php echo htmlspecialchars($title); ?></title>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <main>
      <div>
        <h2>Main Content</h2>
        <?php include $content; ?>
      </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="../js/scripts.js"></script>
    <?php
    if (isset($scripts)) {
      foreach ($scripts as $script) {
        echo '<script src="' . htmlspecialchars($script) . '"></script>';
      }
    }
    ?>
  </body>
</html>