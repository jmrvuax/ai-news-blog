<?php
class PostController {
    public function index() {
        $postModel = new PostModel();
        $posts = $postModel->getAllPosts();
        $title = 'Posts - AI News';
        ob_start();
        include 'views/posts/index.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function create() {
        $title = 'Create Post - AI News';
        ob_start();
        include 'views/posts/create.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function store() {
        $title = sanitize_input($_POST['title']);
        $content = sanitize_input($_POST['content']);
        $postModel = new PostModel();
        $postModel->createPost($title, $content);
        header('Location: /posts');
    }

    public function edit($id) {
        $postModel = new PostModel();
        $post = $postModel->getPostById($id);
        $title = 'Edit Post - AI News';
        ob_start();
        include 'views/posts/edit.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function update($id) {
        $title = sanitize_input($_POST['title']);
        $content = sanitize_input($_POST['content']);
        $postModel = new PostModel();
        $postModel->updatePost($id, $title, $content);
        header('Location: /posts');
    }

    public function delete($id) {
        $postModel = new PostModel();
        $postModel->deletePost($id);
        header('Location: /posts');
    }
}