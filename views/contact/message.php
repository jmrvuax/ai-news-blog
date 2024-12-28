<section class="message-page">
    <div class="message-page-header">
        <a href="/messages" class="page-back-link">Back to Messages</a>
        <h2 class="message-page-title">Message from <?php echo htmlspecialchars($message['name']); ?></h2>
        <p class="message-page-meta">
            <strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?> |
            <strong>Date Sent:</strong> <?php echo htmlspecialchars($message['created_at']); ?>
        </p>
    </div>
    <div class="message-page-content">
        <h3>Message:</h3>
        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
    </div>
</section>