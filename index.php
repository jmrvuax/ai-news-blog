<?php

$routes = [
    '/' => 'home.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php',
];

// Get the current request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string from URI
$request_uri = parse_url($request_uri, PHP_URL_PATH);

// Set default title
$title = 'AI News';

// Determine the template to include based on the route
if (array_key_exists($request_uri, $routes)) {
    $template = $routes[$request_uri];
    // Set page-specific titles
    switch ($request_uri) {
        case '/about':
            $title = 'About Us - AI News';
            break;
        case '/contact':
            $title = 'Contact Us - AI News';
            break;
        default:
            $title = 'Home - AI News';
    }
} else {
    // Handle 404 Not Found
    $template = '404.php';
    $title = 'Page Not Found - AI News';
}

include './templates/header.php';
include './templates/' . $template;
include './templates/footer.php';