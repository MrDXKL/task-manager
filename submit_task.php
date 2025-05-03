<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "task_db";

// Connect
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data
$task = $_POST['task'];

if (!empty($task)) {
    $stmt = $conn->prepare("INSERT INTO tasks (name) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    echo "Task added";
} else {
    echo "No task provided";
}

$conn->close();
?>
