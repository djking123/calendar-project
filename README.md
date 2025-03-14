# Calendar Project

This is a simple calendar application built using PHP, HTML, and CSS, with all data stored in a single SQLite database. The project allows users to view a monthly calendar, add events, and view details of specific events.

## Features

- Monthly calendar view
- Add, update, and delete events
- View event details
- Responsive design

## Project Structure

```
calendar-project
├── assets
│   ├── css
│   │   └── styles.css
├── src
│   ├── database
│   │   └── db.php
│   ├── views
│   │   ├── calendar.php
│   │   └── event.php
│   ├── controllers
│   │   ├── calendarController.php
│   │   └── eventController.php
│   └── models
│       ├── calendarModel.php
│       └── eventModel.php
├── index.php
├── database.sqlite
└── README.md
```

## Setup Instructions

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Ensure you have PHP and SQLite installed on your machine.
4. Open the `index.php` file in your web server or run it using the PHP built-in server.
5. Access the application through your web browser.

## Usage

- To view the calendar, navigate to the main page.
- Click on a date to add or view events.
- Use the provided forms to create or update events.

## Technologies Used

- PHP
- HTML
- CSS
- SQLite

## License

This project is open-source and available for modification and distribution.