<section>
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p><strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
    <p><strong>Date:</strong> <?php echo htmlspecialchars($post['created_at']); ?></p>
    <div>
        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
    </div>
</section>