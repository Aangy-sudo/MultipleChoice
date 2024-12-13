<?php
include 'db.php';
session_start();

header('Content-Type: application/json'); // Set response type to JSON
$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Secure query for admins
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['role'] = 'admin';
        $_SESSION['name'] = $admin['name'];
        $_SESSION['id'] = $admin['id'];

        $response = [
            'success' => true,
            'role' => 'admin',
            'name' => $admin['name']
        ];
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student && password_verify($password, $student['password'])) {
        $_SESSION['role'] = 'student';
        $_SESSION['name'] = $student['name'];
        $_SESSION['id'] = $student['id'];
        $_SESSION['school'] = $student['school'];

        $response = [
            'success' => true,
            'role' => 'student',
            'name' => $student['name']
        ];
        echo json_encode($response);
        exit;
    }

    $response = ['success' => false, 'message' => 'Invalid username or password.'];
    echo json_encode($response);
    exit;
}
