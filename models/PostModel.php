<?php
class PostModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function getAllPosts($limit = null, $offset = null) {
        $posts = [];
        $query = "
            SELECT posts.*, users.name AS author
            FROM posts
            JOIN users ON posts.user_id = users.id
            ORDER BY posts.created_at DESC
        ";
        if ($limit !== null && $offset !== null) {
            $query .= " LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
            $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
        } else {
            $stmt = $this->db->prepare($query);
        }
        $results = $stmt->execute();
        if ($results) {
            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    public function getPostCount() {
        $result = $this->db->querySingle('SELECT COUNT(*) as count FROM posts');
        return $result;
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("
            SELECT posts.*, users.name AS author
            FROM posts
            JOIN users ON posts.user_id = users.id
            WHERE posts.id = :id
        ");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function createPost($title, $content, $userId) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO posts (title, content, user_id, created_at)
                VALUES (:title, :content, :user_id, :created_at)
            ");
            if (!$stmt) {
                throw new Exception('Database error: ' . $this->db->lastErrorMsg());
            }
            $stmt->bindValue(':title', $title, SQLITE3_TEXT);
            $stmt->bindValue(':content', $content, SQLITE3_TEXT);
            $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);
            $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), SQLITE3_TEXT);
            if (!$stmt->execute()) {
                throw new Exception('Database error: ' . $this->db->lastErrorMsg());
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare("
            UPDATE posts
            SET title = :title, content = :content
            WHERE id = :id
        ");
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("
            DELETE FROM posts
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }
}