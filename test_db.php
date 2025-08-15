<?php
// Database Connection Test Script
// This file tests the database connection and provides diagnostic information
// Useful for troubleshooting database issues

// Include database configuration
// This gives us access to the $mysqli connection object
require __DIR__ . '/php/config.php';

echo "<h1>ProGear Hub - Database Test</h1>";

// Test database connectivity using try-catch for proper error handling
// This prevents the script from crashing if there are database issues
try {
    // Test if the database connection is alive
    // ping() returns true if connection is working, false otherwise
    if ($mysqli->ping()) {
        echo "<p style='color: green;'>✅ Database connection successful!</p>";
        
        // Test if we can execute queries
        // SHOW TABLES is a simple query that lists all tables in the database
        $result = $mysqli->query("SHOW TABLES");
        if ($result) {
            echo "<p style='color: green;'>✅ Database query successful!</p>";
            echo "<h3>Available tables:</h3><ul>";
            
            // Loop through each table name returned by the query
            // fetch_array() returns each row as an array
            while ($row = $result->fetch_array()) {
                echo "<li>" . $row[0] . "</li>";  // $row[0] contains the table name
            }
            echo "</ul>";
        } else {
            // If query fails, display the MySQL error message
            echo "<p style='color: red;'>❌ Database query failed: " . $mysqli->error . "</p>";
        }
    } else {
        // If ping fails, the connection is not working
        echo "<p style='color: red;'>❌ Database connection failed!</p>";
    }
} catch (Exception $e) {
    // Catch any exceptions thrown by MySQLi
    // This includes connection errors, authentication failures, etc.
    echo "<p style='color: red;'>❌ Exception: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h2>PHP Information</h2>";

// Display PHP version for debugging purposes
echo "<p>PHP Version: " . phpversion() . "</p>";

// Check if MySQLi extension is loaded
// This is required for database operations
echo "<p>MySQLi Extension: " . (extension_loaded('mysqli') ? '✅ Loaded' : '❌ Not loaded') . "</p>";

echo "<hr>";
echo "<h2>How to use the forms:</h2>";
echo "<ul>";
echo "<li><a href='contact.html'>Contact Form</a> - Go to contact.html to submit contact messages</li>";
echo "<li><a href='orders.html'>Order Form</a> - Go to orders.html to place orders</li>";
echo "</ul>";

// Important security note about direct access
echo "<p><strong>Note:</strong> Do not access php/contact_process.php or php/order_process.php directly. These files only accept POST requests from the forms.</p>";
?>
