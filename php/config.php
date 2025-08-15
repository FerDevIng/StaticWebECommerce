<?php
// Show MySQLi errors as exceptions (so you actually see the problem)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$DB_HOST = 'localhost';   // XAMPP default
$DB_USER = 'root';
$DB_PASS = '1245';        // <-- your root password
$DB_NAME = 'ProGearHub';  // matches the SQL above

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$mysqli->set_charset('utf8mb4');