<section>
  <h2>Latest Articles</h2>
  <ul>
    <?php if (!empty($posts)): ?>
      <?php foreach ($posts as $post): ?>
        <li><?php echo htmlspecialchars($post['title']); ?></li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>No articles available.</li>
    <?php endif; ?>
  </ul>
</section>