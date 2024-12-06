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
                    <a href="/posts/edit/<?php echo urlencode($post['id']); ?>">Edit</a>
                    <a href="/posts/delete/<?php echo urlencode($post['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No posts available.</p>
    <?php endif; ?>
</section>