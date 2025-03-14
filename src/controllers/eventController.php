<?php
require_once '../database/db.php';

class EventController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createEvent($title, $date, $description) {
        $stmt = $this->db->connect()->prepare("INSERT INTO events (title, date, description) VALUES (?, ?, ?)");
        $stmt->execute([$title, $date, $description]);
    }

    public function updateEvent($id, $title, $date, $description) {
        $stmt = $this->db->connect()->prepare("UPDATE events SET title = ?, date = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $date, $description, $id]);
    }

    public function deleteEvent($id) {
        $stmt = $this->db->connect()->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getEvent($id) {
        $stmt = $this->db->connect()->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllEvents() {
        $stmt = $this->db->connect()->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>