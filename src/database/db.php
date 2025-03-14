<?php
// Database connection settings
define('DB_PATH', __DIR__ . '/../../database.sqlite');

function getDatabaseConnection() {
    try {
        $db = new PDO('sqlite:' . DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
        exit();
    }
}

function createTables() {
    $db = getDatabaseConnection();

    // Create events table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS events (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        event_date TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($sql);
}

// Call the function to create tables
createTables();
?>