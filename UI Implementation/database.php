<?php
// Set the error reporting level
error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
    // Create (connect to) SQLite database in file
    $db = new PDO('sqlite:database.db');
    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Uncomment this line to enable foreign key constraints for SQLite
    // $db->exec("PRAGMA foreign_keys = ON;");

    // Create a users table if it doesn't already exist
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )");

    // You can add more table creation statements here if needed

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Use this variable to perform database operations elsewhere in your project
// Include this file and use the $db object for any queries
?>
