<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit;
}

$studentName = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') : 'Student';
$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if (!$userId) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="../assets/quiz.css">
</head>

<body>
    <div id="main-container">
        <header>
            <h2>Welcome, <?= $studentName ?>!</h2>
            <a href="logout.php">Logout</a>
        </header>

        <div id="instructions" class="active">
            <h2>Instructions</h2>
            <p>Please click the button below to start the quiz. Answer the questions one at a time. Good luck!</p>
            <button id="startButton">Start Quiz</button>
        </div>

        <div id="questionContainer" style="display: none;">
            <p id="timer">Time Elapsed: <span>00:00</span></p>
            <div id="questions"></div>
            <button id="checkButton" disabled>Check Answer</button>
            <button id="nextButton" disabled>Next</button>
        </div>

        <div id="congratulations" style="display: none;">
            <h2>Congratulations!</h2>
            <p>You have completed the quiz. Well done!</p>
            <p>Your score is: <span id="finalScore"></span></p>
            <button onclick="location.reload()">Retake Quiz</button>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>

        <footer>
            <p>&copy; <?= date("Y") ?> Quiz System</p>
        </footer>
    </div>

    <script>
        localStorage.setItem('userId', <?= json_encode($userId) ?>);
    </script>
    <script src="../assets/exam.js"></script>
</body>

</html>