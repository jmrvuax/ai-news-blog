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

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $currentPage) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <p>No messages received yet.</p>
    <?php endif; ?>
</section>