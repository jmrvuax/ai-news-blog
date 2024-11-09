<?php
header('Content-Type: application/json');

// Show errors at the moment.
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  // WIP SAve data and send emails

  echo json_encode(['success' => true, 'name' => $name]);
  exit;
}

echo json_encode(['success' => false]);
exit;