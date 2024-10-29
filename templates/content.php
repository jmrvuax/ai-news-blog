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