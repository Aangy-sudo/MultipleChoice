<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

include 'db.php';

$query = "SELECT name, school, score FROM students ORDER BY score DESC";
$result = $conn->query($query);

$leaderboardData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboardData[] = [
            'name' => htmlspecialchars($row['name']),
            'school' => htmlspecialchars($row['school']),
            'score' => htmlspecialchars($row['score']),
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    echo json_encode($leaderboardData);
    exit;
}
