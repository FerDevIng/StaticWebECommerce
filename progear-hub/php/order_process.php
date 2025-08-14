<?php
// php/contact_process.php
require __DIR__ . '/config.php';

// Collect & trim
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];
if ($name === '' || mb_strlen($name) > 255)                               $errors[] = 'Invalid name';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) $errors[] = 'Invalid email';
if ($subject === '' || mb_strlen($subject) > 255)                          $errors[] = 'Invalid subject';
if ($message === '')                                                       $errors[] = 'Message required';

if ($errors) {
  header('Location: /progear-hub/contact.html?status=error');
  exit;
}

$stmt = $pdo->prepare(
  "INSERT INTO contact_us (name, email, subject, message) VALUES (:name, :email, :subject, :message)"
);
$stmt->execute([
  ':name'    => $name,
  ':email'   => $email,
  ':subject' => $subject,
  ':message' => $message
]);

header('Location: /progear-hub/contact.html?status=ok');
