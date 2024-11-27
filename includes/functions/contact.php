<?php
header('Content-Type: application/json');

// Show errors at the moment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
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
    echo json_encode(['success' => true, 'name' => $name]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Email could not be sent.']);
  }
  exit;
}

echo json_encode(['success' => false]);
exit;