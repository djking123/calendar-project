<?php
// Include database connection
require_once '../database/db.php';

// Get the current month and year
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Create a new instance of the database
$db = new Database();
$conn = $db->connect();

// Fetch events for the current month
$stmt = $conn->prepare("SELECT * FROM events WHERE strftime('%m', date) = ? AND strftime('%Y', date) = ?");
$stmt->execute([$month, $year]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the number of days in the month
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Get the first day of the month
$firstDayOfMonth = strtotime("$year-$month-01");
$firstDayOfWeek = date('w', $firstDayOfMonth);

// Display the calendar
echo "<h1>Calendar for " . date('F Y', $firstDayOfMonth) . "</h1>";
echo "<table>";
echo "<tr>";
echo "<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>";
echo "</tr><tr>";

// Fill in the empty cells before the first day of the month
for ($i = 0; $i < $firstDayOfWeek; $i++) {
    echo "<td></td>";
}

// Display the days of the month
for ($day = 1; $day <= $daysInMonth; $day++) {
    // Check if there are events on this day
    $eventList = array_filter($events, function($event) use ($year, $month, $day) {
        return date('Y-m-d', strtotime($event['date'])) === "$year-$month-$day";
    });

    echo "<td>";
    echo $day;
    if (!empty($eventList)) {
        echo "<ul>";
        foreach ($eventList as $event) {
            echo "<li><a href='event.php?id=" . $event['id'] . "'>" . htmlspecialchars($event['title']) . "</a></li>";
        }
        echo "</ul>";
    }
    echo "</td>";

    // Start a new row after Saturday
    if (($day + $firstDayOfWeek) % 7 == 0) {
        echo "</tr><tr>";
    }
}

// Fill in the empty cells after the last day of the month
while (($day + $firstDayOfWeek) % 7 != 0) {
    echo "<td></td>";
    $day++;
}

echo "</tr>";
echo "</table>";

// Navigation for previous and next month
$prevMonth = $month == 1 ? 12 : $month - 1;
$prevYear = $month == 1 ? $year - 1 : $year;
$nextMonth = $month == 12 ? 1 : $month + 1;
$nextYear = $month == 12 ? $year + 1 : $year;

echo "<a href='calendar.php?month=$prevMonth&year=$prevYear'>Previous</a> | ";
echo "<a href='calendar.php?month=$nextMonth&year=$nextYear'>Next</a>";
?>