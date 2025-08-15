<?php
// admin_contacts.php - Admin page to view contact submissions
require __DIR__ . '/php/config.php';

// Simple authentication (in production, use proper authentication)
$admin_password = 'admin123'; // Change this in production

if (isset($_POST['password']) && $_POST['password'] === $admin_password) {
    $_SESSION['admin_logged_in'] = true;
}

if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - ProGear Hub</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 50px; }
            .login-form { max-width: 300px; margin: 0 auto; }
            input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; }
            button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        </style>
    </head>
    <body>
        <div class="login-form">
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="password" name="password" placeholder="Enter admin password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Handle delete action
if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $stmt = $mysqli->prepare("DELETE FROM contact_us WHERE id = ?");
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Get contact submissions
$result = $mysqli->query("SELECT * FROM contact_us ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Submissions - ProGear Hub Admin</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .message-cell { max-width: 300px; word-wrap: break-word; }
        .delete-btn { background: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px; }
        .logout-btn { background: #6c757d; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 3px; }
        .stats { background: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Contact Form Submissions</h1>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="logout" value="1">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <?php
    // Display statistics
    $total_submissions = $result->num_rows;
    $today_submissions = $mysqli->query("SELECT COUNT(*) as count FROM contact_us WHERE DATE(submitted_at) = CURDATE()")->fetch_assoc()['count'];
    ?>
    
    <div class="stats">
        <strong>Statistics:</strong> 
        Total submissions: <?php echo $total_submissions; ?> | 
        Today's submissions: <?php echo $today_submissions; ?>
    </div>

    <?php if ($total_submissions > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td class="message-cell"><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo $row['submitted_at']; ?></td>
                        <td>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No contact submissions found.</p>
    <?php endif; ?>

    <p><a href="contact.html">← Back to Contact Form</a></p>
</body>
</html>
<?php
$mysqli->close();
?>
