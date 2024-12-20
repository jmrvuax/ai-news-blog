<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}