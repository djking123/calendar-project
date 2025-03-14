<?php
class CalendarModel {
    private $db;

    public function __construct($database) {
        $this->db = new PDO("sqlite:" . $database);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getEventsByMonth($year, $month) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE strftime('%Y', date) = :year AND strftime('%m', date) = :month");
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEvents() {
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addEvent($title, $date, $description) {
        $stmt = $this->db->prepare("INSERT INTO events (title, date, description) VALUES (:title, :date, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>