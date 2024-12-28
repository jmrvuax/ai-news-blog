<section>
    <h2>Create Post</h2>
    <form action="/posts/store" method="POST" class="common-form">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required></textarea>
        
        <button type="submit">Create</button>
    </form>
</section>