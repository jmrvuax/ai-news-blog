<?php
session_start();
header('Content-Type: application/json');

// Log errors instead of displaying them
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php-error.log'); // Update this path as needed

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
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

    // Connect to SQLite database
    $db = new SQLite3('/var/www/html/database/users.db'); // Use an absolute path

    // Check credentials
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
      error_log('User found: ' . print_r($user, true)); // Debug statement
      if (password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $email;
        echo json_encode(['success' => true]);
      } else {
        error_log('Password verification failed'); // Debug statement
        echo json_encode(['success' => false, 'error' => 'Invalid email or password.']);
      }
    } else {
      error_log('User not found'); // Debug statement
      echo json_encode(['success' => false, 'error' => 'Invalid email or password.']);
    }
    exit;
  }

  echo json_encode(['success' => false]);
} catch (Exception $e) {
  error_log($e->getMessage());
  echo json_encode(['success' => false, 'error' => 'An unexpected error occurred.']);
}
exit;