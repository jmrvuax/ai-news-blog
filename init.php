<?php

session_start();

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Error reporting and logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php-error.log');

// Autoloader for controllers and models
spl_autoload_register(function ($class) {
    if (file_exists("controllers/$class.php")) {
        require "controllers/$class.php";
    } elseif (file_exists("models/$class.php")) {
        require "models/$class.php";
    }
});

// Helper functions
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function getDbConnection() {
    return new SQLite3('/var/www/html/database/ai_news_blog.db');
}