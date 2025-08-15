<?php
// Test database connection
require __DIR__ . '/php/config.php';

echo "<h1>ProGear Hub - Database Test</h1>";

try {
    // Test the connection
    if ($mysqli->ping()) {
        echo "<p style='color: green;'>✅ Database connection successful!</p>";
        
        // Test a simple query
        $result = $mysqli->query("SHOW TABLES");
        if ($result) {
            echo "<p style='color: green;'>✅ Database query successful!</p>";
            echo "<h3>Available tables:</h3><ul>";
            while ($row = $result->fetch_array()) {
                echo "<li>" . $row[0] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: red;'>❌ Database query failed: " . $mysqli->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Database connection failed!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Exception: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h2>PHP Information</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>MySQLi Extension: " . (extension_loaded('mysqli') ? '✅ Loaded' : '❌ Not loaded') . "</p>";

echo "<hr>";
echo "<h2>How to use the forms:</h2>";
echo "<ul>";
echo "<li><a href='contact.html'>Contact Form</a> - Go to contact.html to submit contact messages</li>";
echo "<li><a href='orders.html'>Order Form</a> - Go to orders.html to place orders</li>";
echo "</ul>";
echo "<p><strong>Note:</strong> Do not access php/contact_process.php or php/order_process.php directly. These files only accept POST requests from the forms.</p>";
?>
