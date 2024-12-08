<?php
include 'db.php';
session_start();
if (!isset($_SESSION['is_admin'])) {
    header('Location: login.php');
    exit();
}

$query = "SELECT * FROM users";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
</head>

<body>
    <h2>Admin Dashboard</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>School</th>
            <th>Username</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['school']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td>
                    <a href="editUser.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="deleteUser.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>