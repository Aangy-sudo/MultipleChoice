<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>
    <header id="header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?= htmlspecialchars($_SESSION['name']) ?>!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <main id="main-container">
        <h2>Manage Your Dashboard</h2>
        <div class="dashboard-sections">
            <div class="dashboard-card">
                <h3>Leaderboard</h3>
                <p>View the top scores of students.</p>
                <a href="leaderboard.php" class="btn">Go to Leaderboard</a>
            </div>
            <div class="dashboard-card">
                <h3>Manage Students</h3>
                <p>Delete or reset scores of students.</p>
                <a href="manageStudents.php" class="btn">Manage Students</a>
            </div>
        </div>
    </main>
</body>

</html>