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

    public function getAllMessages() {
        $results = $this->db->query('SELECT * FROM contact_messages ORDER BY created_at DESC');
        $messages = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $messages[] = $row;
        }
        return $messages;
    }

    public function getMessageById($id) {
        $stmt = $this->db->prepare('SELECT * FROM contact_messages WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function getMessages($limit, $offset) {
        $stmt = $this->db->prepare('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
        $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
        $results = $stmt->execute();
        $messages = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $messages[] = $row;
        }
        return $messages;
    }
    
    public function getMessageCount() {
        $result = $this->db->querySingle('SELECT COUNT(*) as count FROM contact_messages');
        return $result;
    }
}