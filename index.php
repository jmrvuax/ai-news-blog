<?php
require_once 'init.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Use switch (true) to allow for conditional cases
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

    case $requestUri === '/posts':
        $controller = new PostController();
        $controller->index();
        break;

    case $requestUri === '/posts/create':
        $controller = new PostController();
        $controller->create();
        break;

    case $requestUri === '/posts/store' && $_SERVER['REQUEST_METHOD'] === 'POST':
        $controller = new PostController();
        $controller->store();
        break;

    case preg_match('#^/posts/edit/(\d+)$#', $requestUri, $matches):
        $controller = new PostController();
        $controller->edit($matches[1]);
        break;

    case preg_match('#^/posts/update/(\d+)$#', $requestUri, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST':
        $controller = new PostController();
        $controller->update($matches[1]);
        break;

    case preg_match('#^/posts/delete/(\d+)$#', $requestUri, $matches):
        $controller = new PostController();
        $controller->delete($matches[1]);
        break;

    case $requestUri === '/messages':
        $controller = new ContactController();
        $controller->showMessages();
        break;

    // Include the /message/{id} route in the switch
    case preg_match('#^/message/(\d+)$#', $requestUri, $matches):
        $controller = new ContactController();
        $controller->viewMessage($matches[1]);
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