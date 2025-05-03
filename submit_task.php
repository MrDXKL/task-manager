<?php
$host = 'localhost';
$db = 'taskdb';
$user = 'root';
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$task = $_POST['task'] ?? '';
if (!empty($task)) {
    $stmt = $conn->prepare("INSERT INTO tasks (name) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
