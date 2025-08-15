<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $subject === '' || $message === '') {
  header('Location: ../contact.html?error=1');
  exit;
}

$stmt = $mysqli->prepare(
  'INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)'
);
$stmt->bind_param('ssss', $name, $email, $subject, $message);
$stmt->execute();

header('Location: ../contact.html?sent=1');
exit;
