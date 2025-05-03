<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$task = $conn->real_escape_string($data["task"]);

$sql = "INSERT INTO tasks (name) VALUES ('$task')";
$conn->query($sql);

$conn->close();
?>
