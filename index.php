<?php
// Include the database connection
require_once 'src/database/db.php';

// Include the controllers
require_once 'src/controllers/calendarController.php';
require_once 'src/controllers/eventController.php';

// Determine the requested action
$action = isset($_GET['action']) ? $_GET['action'] : 'calendar';

// Route to the appropriate view
switch ($action) {
    case 'event':
        // Show event details
        eventController::showEvent();
        break;
    case 'calendar':
    default:
        // Show the calendar view
        calendarController::showCalendar();
        break;
}
?>