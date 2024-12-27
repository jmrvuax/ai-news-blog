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
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'error' => 'Invalid CSRF token.']);
            exit;
        }

        $name = sanitize_input($_POST['name']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = sanitize_input($_POST['password']);
        $confirmPassword = sanitize_input($_POST['confirm_password']);

        // Server-side validation
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
            exit;
        }

        if ($password !== $confirmPassword) {
            echo json_encode(['success' => false, 'error' => 'Passwords do not match.']);
            exit;
        }

        $userModel = new UserModel();
        if ($userModel->getUserByEmail($email)) {
            echo json_encode(['success' => false, 'error' => 'Email is already registered.']);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $userModel->createUser($name, $email, $hashedPassword);

        echo json_encode(['success' => true]);
        exit;
    }
}