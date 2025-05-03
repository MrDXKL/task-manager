<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    exit('Only POST requests are allowed.');
}

$host = 'sql112.infinityfree.com';
$db = 'if0_38134885_dataa';
$user = 'if0_38134885';
$pass = '،هممثق_1423';        

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
