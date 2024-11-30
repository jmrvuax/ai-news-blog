<?php
require_once 'init.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;
    case '/about':
        $controller = new AboutController();
        $controller->index();
        break;
    case '/contact':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ContactController();
            $controller->submitForm();
        } else {
            $controller = new ContactController();
            $controller->showForm();
        }
        break;
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->login();
        } else {
            $controller = new AuthController();
            $controller->showLoginForm();
        }
        break;
    case '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        http_response_code(404);
        $title = '404 - Page Not Found';
        ob_start();
        include 'views/404.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
        break;
}