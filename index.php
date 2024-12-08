<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: quiz.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Quiz</title>
    <link rel="stylesheet" href="./assets/exam.css">
</head>

<body>
    <div id="main-container">
        <form method="POST" action="quiz.php" onsubmit="saveUserDetails(document.getElementById('name').value, document.getElementById('school').value);">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="school">School/University:</label>
            <input type="text" id="school" name="school" required>
            <button type="submit">Start Quiz</button>
        </form>
        <p>Don't have an account? <a href="./php/registration.php">Register here</a>.</p>
    </div>
</body>

</html>