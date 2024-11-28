<?php
session_start();

// Generate CSRF token if not already set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$routes = [
    '/' => 'home.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php',
    '/login' => 'login.php',
];

// Get the current request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string from URI
$request_uri = parse_url($request_uri, PHP_URL_PATH);

// Set default title
$title = 'AI News';

// Determine the template to include based on the route
if (array_key_exists($request_uri, $routes)) {
    $content = './templates/' . $routes[$request_uri];
    // Set page-specific titles
    switch ($request_uri) {
        case '/about':
            $title = 'About Us - AI News';
            break;
        case '/contact':
            $title = 'Contact Us - AI News';
            break;
        case '/login':
            $title = 'Login - AI News';
            break;
        default:
            $title = 'Home - AI News';
    }
} else {
    // Handle 404 Not Found
    $content = './templates/404.php';
    $title = 'Page Not Found - AI News';
}

// Validate CSRF token for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? '';
    if ($csrfToken !== $_SESSION['csrf_token']) {
        echo json_encode(['success' => false, 'error' => 'Invalid CSRF token.']);
        exit;
    }
}

include './templates/layout.php';