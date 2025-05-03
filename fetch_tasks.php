<?php
$host = 'localhost';
$db = 'task_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

header('Content-Type: application/json');

$result = $conn->query("SELECT * FROM tasks");
$tasks = [];

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);

$conn->close();
?>
