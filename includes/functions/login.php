<?php
session_start();
header('Content-Type: application/json');

// Show errors at the moment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  // Server-side validation
  if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
    exit;
  }

  // Dummy user data for demonstration purposes
  $dummyUser = [
    'email' => 'user@example.com',
    'password' => 'password123'
  ];

  // Check credentials
  if ($email === $dummyUser['email'] && $password === $dummyUser['password']) {
    $_SESSION['user'] = $email;
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => 'Invalid email or password.']);
  }
  exit;
}

echo json_encode(['success' => false]);
exit;