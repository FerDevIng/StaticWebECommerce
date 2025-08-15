<?php
require __DIR__ . '/php/config.php';
$res = $mysqli->query('SELECT id,name,email,subject,message,submitted_at FROM contact_us ORDER BY id DESC LIMIT 50');
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Contacts</title>
<link rel="stylesheet" href="css/styles.css">
<style>table{width:100%;border-collapse:collapse}td,th{border:1px solid #ddd;padding:8px}th{background:#eee;text-align:left}</style>
</head><body>
<main>
  <h2>Recent Contact Messages</h2>
  <table>
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Submitted</th></tr></thead>
    <tbody>
      <?php while($row=$res->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['subject']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
          <td><?= htmlspecialchars($row['submitted_at']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>
</body></html>
