<?php
include 'db.php';
session_start();

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['delete_id'])) {
        $delete_id = intval($data['delete_id']);

        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => "Student successfully deleted."];
        } else {
            $response = ['success' => false, 'message' => "Failed to delete student."];
        }
    } else {
        $response = ['success' => false, 'message' => "No delete ID provided."];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, name, school, username, score FROM students ORDER BY id ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($students);
    exit;
}
