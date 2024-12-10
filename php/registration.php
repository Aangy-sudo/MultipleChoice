<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $role = $_POST['role'];
    $school = $role === 'student' ? $_POST['school'] : null;

    // Validate name
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $message = "Name should contain only letters and spaces.";
    } else {
        // Use prepared statements
        if ($role === 'student') {
            $stmt = $conn->prepare("INSERT INTO students (username, password, name, school, score) VALUES (?, ?, ?, ?, ?)");
            $defaultScore = 0;
            $stmt->bind_param("ssssi", $username, $password, $name, $school, $defaultScore);
        } else {
            $stmt = $conn->prepare("INSERT INTO admins (username, password, name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $name);
        }

        if ($stmt->execute()) {
            $message = "Registration successful! Redirecting to login...";
            echo "<script>
                    setTimeout(() => { window.location.href = 'login.php'; }, 3000);
                  </script>";
        } else {
            $message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../assets/registration.css">
</head>

<body>
    <div class="registration-container">
        <h1>Register</h1>
        <?php if ($message): ?>
            <div class="notification"><?= $message ?></div>
        <?php endif; ?>
        <form action="registration.php" method="POST">
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="school" id="school" placeholder="School (for students)" style="display:none;">
            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        document.getElementById('role').addEventListener('change', (e) => {
            const schoolInput = document.getElementById('school');
            schoolInput.style.display = e.target.value === 'student' ? 'block' : 'none';
        });
    </script>
</body>

</html>