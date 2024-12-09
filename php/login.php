<?php
include 'db.php';
session_start();

$error = false; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check admins table
    $query = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['role'] = 'admin';
        $_SESSION['name'] = $admin['name'];
        header('Location: admin.php');
        exit;
    }

    // Check students table
    $query = "SELECT * FROM students WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);

    if ($student && password_verify($password, $student['password'])) {
        $_SESSION['role'] = 'student';
        $_SESSION['name'] = $student['name'];
        $_SESSION['school'] = $student['school'];
        header('Location: quiz.php');
        exit;
    }

    // Set error flag
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <?php if ($error): ?>
                <p class="error">Invalid username or password.</p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</body>

</html>