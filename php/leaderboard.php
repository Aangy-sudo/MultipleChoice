<?php
include 'db.php';

// Fetch leaderboard data
$query = "SELECT name, school, score FROM students ORDER BY score DESC LIMIT 10";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="../assets/leaderboard.css">
</head>

<body>
    <div id="main-container">
        <h2>Leaderboard</h2>
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
                if (mysqli_num_rows($result) > 0) {
                    $rank = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$rank}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['school']}</td>
                                <td>{$row['score']}</td>
                              </tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>
</body>

</html>