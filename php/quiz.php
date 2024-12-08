<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$name = $_SESSION['name'];
$school = $_SESSION['school'];
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
            <h2>Welcome, <?php echo htmlspecialchars($name); ?> from <?php echo htmlspecialchars($school); ?>!</h2>
            <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
            <a href="logout.php">Logout</a>
        </header>

        <!-- Instructions Section -->
        <div id="instructions" class="active">
            <h2>Instructions</h2>
            <p>Please click the button below to start the quiz. Answer the questions one at a time. Good luck!</p>
            <button id="startButton">Start Quiz</button>
        </div>

        <!-- Question Section -->
        <div id="questionContainer">
            <p id="timer">Time Elapsed: <span>00:00</span></p>
            <div id="questions"></div>
            <button id="checkButton" disabled>Check Answer</button>
            <button id="nextButton" disabled>Next</button>
        </div>

        <!-- Completion Section -->
        <div id="congratulations" style="display: none;">
            <h2>Congratulations!</h2>
            <p>You have completed the quiz. Well done!</p>
            <p>Your score is: <span id="finalScore"></span></p>
            <button onclick="viewLeaderboard()">View Leaderboard</button>
        </div>

        <script>
            function viewLeaderboard() {
                window.location.href = 'result.php';
            }
        </script>

    </div>

    <script src="../assets/exam.js"></script>
</body>

</html>