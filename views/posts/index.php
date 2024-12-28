<section>
    <h2>Posts</h2>
    <a href="/posts/create">Create New Post</a>
    <?php if (!empty($posts)): ?>
    <table class="common-table">
        <thead>
            <tr>
                <th><a href="?sort=id" aria-label="Sort by ID">ID</a></th>
                <th><a href="?sort=title" aria-label="Sort by Title">Title</a></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td data-label="ID"><?php echo htmlspecialchars($post['id']); ?></td>
                <td data-label="Title"><?php echo htmlspecialchars($post['title']); ?></td>
                <td data-label="Actions">
                    <a href="/posts/<?php echo urlencode($post['id']); ?>" aria-label="View post <?php echo htmlspecialchars($post['title']); ?>">View</a>
                    <a href="/posts/edit/<?php echo urlencode($post['id']); ?>" aria-label="Edit post <?php echo htmlspecialchars($post['title']); ?>">Edit</a>
                    <a href="/posts/delete/<?php echo urlencode($post['id']); ?>" onclick="return confirm('Are you sure?')" aria-label="Delete post <?php echo htmlspecialchars($post['title']); ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination" role="navigation" aria-label="Pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous page">&laquo; Previous</a>
        <?php endif; ?>
        <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $currentPage) echo 'class="active"'; ?> aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next page">Next &raquo;</a>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <p>No posts available.</p>
    <?php endif; ?>
</section>