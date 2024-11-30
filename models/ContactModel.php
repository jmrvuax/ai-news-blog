<?php
class ContactModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function storeMessage($name, $email, $message) {
        $stmt = $this->db->prepare('INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->execute();
    }
}