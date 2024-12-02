<section>
    <h2>Contact Messages</h2>
    <?php if (!empty($messages)): ?>
    <table class="messages-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Sent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td data-label="ID"><?php echo htmlspecialchars($message['id']); ?></td>
                <td data-label="Name"><?php echo htmlspecialchars($message['name']); ?></td>
                <td data-label="Date"><?php echo htmlspecialchars($message['created_at']); ?></td>
                <td data-label="Actions"><a href="/message/<?php echo urlencode($message['id']); ?>">View</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No messages received yet.</p>
    <?php endif; ?>
</section>