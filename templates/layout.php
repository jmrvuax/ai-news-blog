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
    <?php include $content; ?>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>