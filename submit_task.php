<?php
$host = 'localhost';
$db = 'task_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO tasks (name) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>
