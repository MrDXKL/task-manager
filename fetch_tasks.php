<?php
$host = 'localhost';
$db = 'task_db';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
$tasks = [];

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);

$conn->close();
?>
