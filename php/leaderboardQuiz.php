<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized access. Please log in.',
    ]);
    exit;
}

include 'db.php';

$query = "SELECT name, school, score FROM students ORDER BY score DESC LIMIT 10";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$leaderboard = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = [
            'name' => htmlspecialchars($row['name']),
            'school' => htmlspecialchars($row['school']),
            'score' => (int)$row['score'],
        ];
    }
}

echo json_encode([
    'success' => true,
    'leaderboard' => $leaderboard,
]);
