<?php
require_once 'db_config.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = connect();
    }

    public function getAllTasks() {
        $query = "SELECT * FROM tasks";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask($task) {
        $query = "INSERT INTO tasks (task, completed) VALUES (:task, 0)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task', $task);
        return $stmt->execute();
    }

    public function markTaskAsCompleted($id) {
        $query = "UPDATE tasks SET completed = 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
