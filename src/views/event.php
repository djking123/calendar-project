<?php
// Include the database connection
require_once '../database/db.php';

// Check if the event ID is set in the URL
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Fetch the event details from the database
    $db = new Database();
    $event = $db->getEventById($eventId);

    if ($event) {
        // Display the event details
        echo "<h1>" . htmlspecialchars($event['title']) . "</h1>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($event['date']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($event['description']) . "</p>";
    } else {
        echo "<p>Event not found.</p>";
    }
} else {
    echo "<p>No event ID provided.</p>";
}
?>