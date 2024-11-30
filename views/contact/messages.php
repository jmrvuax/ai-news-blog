<section>
    <h2>Contact Messages</h2>
    <?php if (!empty($messages)): ?>
    <table class="messages-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date Sent</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?php echo htmlspecialchars($message['id']); ?></td>
                <td><?php echo htmlspecialchars($message['name']); ?></td>
                <td><?php echo htmlspecialchars($message['email']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($message['message'])); ?></td>
                <td><?php echo htmlspecialchars($message['created_at']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No messages received yet.</p>
    <?php endif; ?>
</section>