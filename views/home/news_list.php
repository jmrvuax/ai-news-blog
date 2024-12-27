<section>
  <h2>Latest Articles</h2>
  <ul id="post-list">
    <?php if (!empty($posts)): ?>
      <?php foreach ($posts as $post): ?>
        <li>
          <h3><?php echo htmlspecialchars($post['title']); ?></h3>
          <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
          <p><strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
          <p><strong>Date:</strong> <?php echo htmlspecialchars($post['created_at']); ?></p>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>No articles available.</li>
    <?php endif; ?>
  </ul>
  <?php if ($totalPages > 1): ?>
    <button id="load-more" data-page="1">Load More</button>
  <?php endif; ?>
</section>