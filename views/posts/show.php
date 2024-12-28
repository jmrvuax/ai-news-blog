<section class="post-page">
    <div class="post-page-header">
        <?php if (!empty($_SESSION['user'])): ?>
            <a href="/posts" class="page-back-link">Back to Post List</a>
        <?php else: ?>
            <a href="/" class="page-back-link">Back to Home</a>
        <?php endif; ?>
        <h1 class="post-page-title"><?php echo htmlspecialchars($post['title']); ?></h1>
        <p class="post-page-meta">Published on <?php echo htmlspecialchars($post['date']); ?> by <?php echo htmlspecialchars($post['author']); ?></p>
    </div>
    <div class="post-page-content">
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
    </div>
</section>