<section>
    <h2>Edit Post</h2>
    <form action="/posts/update/<?php echo htmlspecialchars($post['id']); ?>" method="POST" class="commonForm">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        
        <button type="submit">Update</button>
    </form>
</section>