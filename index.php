<?php
require_once 'init.php';

session_start();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch (true) {
    case $requestUri === '/':
        $controller = new HomeController();
        $controller->index();
        break;

    case $requestUri === '/about':
        $controller = new AboutController();
        $controller->index();
        break;

    case $requestUri === '/contact' && $_SERVER['REQUEST_METHOD'] === 'POST':
        $controller = new ContactController();
        $controller->submitForm();
        break;

    case $requestUri === '/contact':
        $controller = new ContactController();
        $controller->showForm();
        break;

    case $requestUri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST':
        $controller = new AuthController();
        $controller->login();
        break;

    case $requestUri === '/login':
        $controller = new AuthController();
        $controller->showLoginForm();
        break;

    case $requestUri === '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case preg_match('#^/posts/(\d+)$#', $requestUri, $matches):
        $controller = new PostController('show');
        $controller->show($matches[1]);
        break;

    case $requestUri === '/posts/loadMore':
        $controller = new PostController('loadMore');
        $controller->loadMore();
        break;

    case $requestUri === '/posts':
    case $requestUri === '/posts/create':
    case $requestUri === '/posts/store' && $_SERVER['REQUEST_METHOD'] === 'POST':
    case preg_match('#^/posts/edit/(\d+)$#', $requestUri, $matches):
    case preg_match('#^/posts/update/(\d+)$#', $requestUri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST':
    case preg_match('#^/posts/delete/(\d+)$#', $requestUri, $matches):
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        if ($requestUri === '/posts') {
            $controller = new PostController('index');
            $controller->index();
        } elseif ($requestUri === '/posts/create') {
            $controller = new PostController('create');
            $controller->create();
        } elseif ($requestUri === '/posts/store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new PostController('store');
            $controller->store();
        } elseif (preg_match('#^/posts/edit/(\d+)$#', $requestUri, $matches)) {
            $controller = new PostController('edit');
            $controller->edit($matches[1]);
        } elseif (preg_match('#^/posts/update/(\d+)$#', $requestUri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new PostController('update');
            $controller->update($matches[1]);
        } elseif (preg_match('#^/posts/delete/(\d+)$#', $requestUri, $matches)) {
            $controller = new PostController('delete');
            $controller->delete($matches[1]);
        }
        break;

    case preg_match('#^/message/(\d+)$#', $requestUri, $matches):
        $controller = new ContactController();
        $controller->viewMessage($matches[1]);
        break;

    case $requestUri === '/messages':
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        $controller = new ContactController();
        $controller->showMessages();
        break;

    case $requestUri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST':
        $controller = new RegisterController();
        $controller->register();
        break;

    case $requestUri === '/register':
        $controller = new RegisterController();
        $controller->showRegisterForm();
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