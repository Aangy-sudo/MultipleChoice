<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = trim($_POST['name']);
    $role = $_POST['role'];
    $school = $role === 'student' ? trim($_POST['school']) : null;

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $message = "Name should contain only letters and spaces.";
    } else {
        try {
            if ($role === 'student') {
                $stmt = $conn->prepare("INSERT INTO students (username, password, name, school, score) VALUES (?, ?, ?, ?, 0)");
                $stmt->bind_param("ssss", $username, $password, $name, $school);
            } else if ($role === 'admin') {
                $stmt = $conn->prepare("INSERT INTO admins (username, password, name) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $name);
            } else {
                throw new Exception("Invalid role selected.");
            }

            if ($stmt->execute()) {
                header("Content-Type: application/json");
                echo json_encode(["success" => true, "message" => "Registration successful!"]);
                exit;
            } else {
                throw new Exception("Database error: " . $conn->error);
            }
        } catch (Exception $e) {
            $message = "An error occurred: " . $e->getMessage();
        }
    }

    header("Content-Type: application/json");
    echo json_encode(["success" => false, "message" => $message]);
    exit;
}
