<?php
class AboutController {
    public function index() {
        $title = 'About Us - AI News';
        ob_start();
        include 'views/about/index.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }
}