<?php
class ContactController {
    public function showForm() {
        $title = 'Contact Us - AI News';
        $scripts = ['/js/contact.js'];
        ob_start();
        include 'views/contact/form.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function submitForm() {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            echo json_encode(['success' => false, 'error' => 'Invalid CSRF token.']);
            exit;
        }

        $name = sanitize_input($_POST['name']);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $message = sanitize_input($_POST['message']);

        // Server-side validation
        if (empty($name) || empty($email) || empty($message)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
            exit;
        }

        // Store the message in the database
        $contactModel = new ContactModel();
        $contactModel->storeMessage($name, $email, $message);

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

    public function showMessages() {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    
        $contactModel = new ContactModel();
        $totalMessages = $contactModel->getMessageCount();
        $messagesPerPage = 5; // Number of messages per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $messagesPerPage;
    
        $messages = $contactModel->getMessages($messagesPerPage, $offset);
    
        $totalPages = ceil($totalMessages / $messagesPerPage);
    
        $title = 'Contact Messages - AI News';
        ob_start();
        include 'views/contact/messages.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }

    public function viewMessage($id) {
        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    
        $contactModel = new ContactModel();
        $message = $contactModel->getMessageById($id);
    
        if (!$message) {
            http_response_code(404);
            $title = 'Message Not Found';
            ob_start();
            include 'views/404.php';
            $content = ob_get_clean();
            include 'views/layouts/layout.php';
            return;
        }
    
        $title = 'Message from ' . htmlspecialchars($message['name']);
        ob_start();
        include 'views/contact/message.php';
        $content = ob_get_clean();
        include 'views/layouts/layout.php';
    }
}