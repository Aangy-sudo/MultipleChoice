<?php
include 'db.php';

// Decode the incoming JSON request
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'] ?? null; // Get user_id
$score = $data['score'] ?? null; // Get score

// Validate the inputs
if (!$user_id || !$score) {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
    error_log('Invalid input: user_id or score is missing.');
    exit();
}

// Update the score in the database
$sql = "UPDATE students SET score = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $score, $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to update score']);
    error_log('Failed to update score: ' . $stmt->error);
}

$stmt->close();
