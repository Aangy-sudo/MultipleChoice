<?php
include 'db.php';
session_start();

// Restrict access to admins
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
//     header('Location: login.php');
//     exit();
// }

$query = "SELECT id, name, school, username, score FROM users ORDER BY id ASC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/manageStudents.css">
</head>

<body>
    <div id="main-container">
        <div id="back-to-dashboard">
            <a href="admin.php" class="btn">Back to Dashboard</a>
        </div>
        <div id="header">
            <h1>Manage Users</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['school']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['score']); ?></td>
                        <td>
                            <form method="POST" action="delete_user.php">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>