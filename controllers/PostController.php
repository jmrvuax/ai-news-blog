<?php
class PostController {
    private $action;

    public function __construct($action) {
        $this->action = $action;
        // Check if user is logged in for all actions except 'show' and 'loadMore'
        $publicActions = ['show', 'loadMore'];
        if (!in_array($this->action, $publicActions) && !isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    public function index() {
        $postModel = new PostModel();
        $totalPosts = $postModel->getPostCount();
        $postsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $postsPerPage;

        $posts = $postModel->getAllPosts($postsPerPage, $offset);
        $totalPages = ceil($totalPosts / $postsPerPage);

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
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $title = sanitize_input($_POST['title']);
        $content = sanitize_input($_POST['content']);
        $email = $_SESSION['user'];

        // Retrieve the user ID by email
        $userModel = new UserModel();
        $userData = $userModel->getUserByEmail($email);
        $userId = $userData['id'];

        $postModel = new PostModel();
        $postModel->createPost($title, $content, $userId);

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

    public function loadMore() {
        $postModel = new PostModel();
        $postsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $postsPerPage;

        $posts = $postModel->getAllPosts($postsPerPage, $offset);
        echo json_encode($posts);
    }

    public function show($id) {
        $postModel = new PostModel();
        $post = $postModel->getPostById($id);
        if (!$post) {
            http_response_code(404);
            $title = 'Post Not Found';
            ob_start();
            include 'views/404.php';
            $content = ob_get_clean();
            include 'views/layouts/layout.php';
            return;
        }
        $title = htmlspecialchars($post['title']) . ' - AI News';
        ob_start();
        include 'views/posts/show.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }
}