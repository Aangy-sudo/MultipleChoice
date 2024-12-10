<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $role = $_POST['role'];
    $school = $role === 'student' ? $_POST['school'] : null;

    // Basic validation for name
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $message = "Name should contain only letters and spaces.";
    } else {
        try {
            if ($role === 'student') {
                $stmt = $conn->prepare("INSERT INTO students (username, password, name, school, score) VALUES (?, ?, ?, ?, 0)");
                $stmt->bind_param("ssss", $username, $password, $name, $school);
            } else {
                $stmt = $conn->prepare("INSERT INTO admins (username, password, name) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $name);
            }

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $message = "Error: " . $conn->error;
            }
        } catch (Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
        }
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
            <div class="notification"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form action="registration.php" method="POST">
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="text" name="name" id="name" placeholder="Name" required>
            <input type="text" name="school" id="school" placeholder="School (for students)" style="display:none;">
            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        // Show or hide the school input based on role selection
        document.getElementById('role').addEventListener('change', function() {
            var schoolInput = document.getElementById('school');
            var schoolLabel = document.getElementById('school-label');
            if (this.value === 'student') {
                schoolInput.style.display = 'block';
                schoolLabel.style.display = 'block';
            } else {
                schoolInput.style.display = 'none';
                schoolLabel.style.display = 'none';
            }
        });
    </script>
</body>

</html>