<section>
    <h2>Posts</h2>
    <a href="/posts/create">Create New Post</a>
    <?php if (!empty($posts)): ?>
    <table class="common-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td data-label="ID"><?php echo htmlspecialchars($post['id']); ?></td>
                <td data-label="Title"><?php echo htmlspecialchars($post['title']); ?></td>
                <td data-label="Actions">
                    <a href="/posts/<?php echo urlencode($post['id']); ?>">View</a>
                    <a href="/posts/edit/<?php echo urlencode($post['id']); ?>">Edit</a>
                    <a href="/posts/delete/<?php echo urlencode($post['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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
    <p>No posts available.</p>
    <?php endif; ?>
</section>