<?php
require_once '../models/calendarModel.php';

class CalendarController {
    private $calendarModel;

    public function __construct() {
        $this->calendarModel = new CalendarModel();
    }

    public function displayCalendar($month = null, $year = null) {
        if (is_null($month) || is_null($year)) {
            $month = date('m');
            $year = date('Y');
        }

        $events = $this->calendarModel->getEventsByMonth($month, $year);
        include '../views/calendar.php';
    }
}
?>