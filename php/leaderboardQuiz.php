<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Leaderboard</title>
    <link rel="stylesheet" href="../assets/leaderboard.css?v=1.2">
</head>

<body>
    <div id="main-container">
        <h2>Quiz Leaderboard</h2>
        <p>Top performers among students</p>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';

                $query = "SELECT name, school, score FROM students ORDER BY score DESC LIMIT 10";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    $rank = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$rank}</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['school']) . "</td>
                                <td>" . htmlspecialchars($row['score']) . "</td>
                              </tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button onclick="location.href='quiz.php'" class="btn">Back to Quiz</button>
        <button onclick="location.href='logout.php'" class="btn">Logout</button>
    </div>
</body>

</html>