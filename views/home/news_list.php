<section class="news-section">
  <h2 class="section-title">Latest Articles</h2>
  <ul class="news-list">
    <?php if (!empty($posts)): ?>
      <?php foreach ($posts as $post): ?>
        <li class="news-item">
          <a href="/posts/<?php echo urlencode($post['id']); ?>" class="news-link">
            <h3 class="news-title"><?php echo htmlspecialchars($post['title']); ?></h3>
            <p class="news-content"><?php echo nl2br(htmlspecialchars(substr($post['content'], 0, 100))); ?>...</p>
            <p class="news-meta">
              <span class="news-author"><strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?></span> |
              <span class="news-date"><strong>Date:</strong> <?php echo htmlspecialchars($post['created_at']); ?></span>
            </p>
          </a>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li class="news-item no-articles">No articles available.</li>
    <?php endif; ?>
  </ul>
  <?php if ($totalPages > 1): ?>
    <button id="load-more" class="load-more" data-page="1">Load More</button>
  <?php endif; ?>
</section>