<?php
class EventModel {
    private $db;

    public function __construct($database) {
        $this->db = new PDO("sqlite:" . $database);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createEvent($title, $description, $date) {
        $stmt = $this->db->prepare("INSERT INTO events (title, description, date) VALUES (:title, :description, :date)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        return $stmt->execute();
    }

    public function getEvent($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllEvents() {
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateEvent($id, $title, $description, $date) {
        $stmt = $this->db->prepare("UPDATE events SET title = :title, description = :description, date = :date WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>