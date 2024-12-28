<?php
class HomeController {
    public function index() {
        $postModel = new PostModel();
        $totalPosts = $postModel->getPostCount();
        $postsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $postsPerPage;

        $posts = $postModel->getAllPosts($postsPerPage, $offset);
        $totalPages = ceil($totalPosts / $postsPerPage);
        $scripts = ['/js/slider.js'];

        $title = 'Home - AI News';
        ob_start();
        include 'views/home/index.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }
}