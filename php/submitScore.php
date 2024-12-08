<?php
include 'db.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$score = $data['score'];
$user_id = $_SESSION['user_id'];

$query = "UPDATE users SET score = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $score, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to save score."]);
}
