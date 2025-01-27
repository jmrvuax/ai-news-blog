<?php

class RegisterController {
    public function showRegisterForm() {
        $title = 'Register - AI News';
        $scripts = ['/js/register.js'];
        
        ob_start();
        include 'views/auth/register.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function register() {
        header('Content-Type: application/json');

        // Validate the CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'errors' => ['Invalid CSRF token.']]);
            exit;
        }

        // Sanitize and retrieve user inputs
        $name = sanitize_input($_POST['name']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = sanitize_input($_POST['password']);
        $confirmPassword = sanitize_input($_POST['confirm_password']);

        // Initialize an array to hold validation errors
        $errors = [];

        // Validate the name field
        if (empty($name)) {
            $errors[] = 'Name is required.';
        } elseif (strlen($name) < 3) {
            $errors[] = 'Name must be at least 3 characters long.';
        }

        // Validate the email field
        if (empty($email)) {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address.';
        }

        // Validate the password field
        if (empty($password)) {
            $errors[] = 'Password is required.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'Password must contain at least one uppercase letter.';
        }
        if (!preg_match('/\d/', $password)) {
            $errors[] = 'Password must contain at least one number.';
        }
        if (!preg_match('/[@$!%*?&]/', $password)) {
            $errors[] = 'Password must contain at least one special character.';
        }

        // Validate that passwords match
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
        }

        // Check if there are validation errors
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }

        // Check if the email is already registered
        $userModel = new UserModel();
        if ($userModel->getUserByEmail($email)) {
            echo json_encode(['success' => false, 'errors' => ['Email is already registered.']]);
            exit;
        }

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Create the user in the database
        $userModel->createUser($name, $email, $hashedPassword);

        // Return a success response
        echo json_encode(['success' => true]);
        exit;
    }
}