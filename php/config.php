<?php
// Database Configuration for ProGear Hub
// This file establishes the MySQL connection and sets up error handling

// Configure MySQLi to throw exceptions instead of just warnings
// This makes debugging much easier as you'll see actual error messages
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection parameters for XAMPP environment
$DB_HOST = 'localhost';   // XAMPP default - MySQL runs on same machine
$DB_USER = 'root';        // Default XAMPP admin user
$DB_PASS = '1245';        // Your specific root password - change this in production
$DB_NAME = 'ProGearHub';  // Database name - must match the schema file

// Create new MySQLi connection object
// This establishes the actual connection to the database
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Set character encoding to utf8mb4
// This ensures proper handling of special characters, emojis, and international text
// utf8mb4 is the modern standard that supports 4-byte UTF-8 characters
$mysqli->set_charset('utf8mb4');