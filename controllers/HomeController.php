<?php
class HomeController {
    public function index() {
        $title = 'Home - AI News';
        ob_start();
        include 'views/home/index.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }
}