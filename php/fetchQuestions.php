<?php
include 'db.php';

header('Content-Type: application/json');

$query = "SELECT id, question, option_a, option_b, option_c, option_d, correct_option FROM questions ORDER BY RAND() LIMIT 20";
$result = $conn->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode($questions);
