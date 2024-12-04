<?php
class PostModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function getAllPosts() {
        $results = $this->db->query('SELECT * FROM posts ORDER BY created_at DESC');
        $posts = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $posts[] = $row;
        }
        return $posts;
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function createPost($title, $content) {
        $stmt = $this->db->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        $stmt->execute();
    }

    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }
}