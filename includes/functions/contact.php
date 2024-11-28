<?php
header('Content-Type: application/json');

// Log errors instead of displaying them
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php-error.log'); // Update this path as needed

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate CSRF token
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['success' => false, 'error' => 'Invalid CSRF token.']);
    exit;
  }

  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST['message']);

  // Server-side validation
  if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
    exit;
  }

  // Send a thank you email to the user
  $subject = "Thank you for contacting AI News";
  $body = "Dear $name,\n\nThank you for contacting the AI News team. We will read your email ASAP.\n\nBest regards,\nAI News Team";
  $headers = "From: no-reply@example.com";

  if (mail($email, $subject, $body, $headers)) {
    echo json_encode(['success' => true, 'name' => htmlspecialchars($name)]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Email could not be sent.']);
  }
  exit;
}

echo json_encode(['success' => false]);
exit;