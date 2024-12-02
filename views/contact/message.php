<section>
    <a href="/messages">Back to Messages</a>
    <h2>Message from <?php echo htmlspecialchars($message['name']); ?></h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?></p>
    <p><strong>Date Sent:</strong> <?php echo htmlspecialchars($message['created_at']); ?></p>
    <h3>Message:</h3>
    <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
</section>