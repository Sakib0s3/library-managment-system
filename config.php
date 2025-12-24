<?php
// ===== Database Configuration =====
// Change these if your MySQL credentials are different
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "library_db";

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set charset (good for Bangla/UTF-8 too)
$conn->set_charset("utf8mb4");
?>