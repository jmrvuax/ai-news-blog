<?php
class AuthController {
    public function showLoginForm() {
        $title = 'Login - AI News';
        $scripts = ['/js/login.js'];
        ob_start();
        include 'views/auth/login.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function login() {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'error' => 'Invalid CSRF token.']);
            exit;
        }

        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = sanitize_input($_POST['password']);

        // Server-side validation
        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $email;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid email or password.']);
        }
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}