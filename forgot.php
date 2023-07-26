<?php
include('connection.php');

$recovery_email = $_POST["email"];
$recovery_answer = $_POST["answer"];

$query = $mysqli->prepare("SELECT password FROM users WHERE email = ? AND questions = ?");
$query->bind_param("ss",$recovery_email,$recovery_answer);
$query->execute();

$selectResult = $query->get_result();
$userData = $selectResult->fetch_assoc();

if ($selectResult->num_rows > 0) {
    $response["status"] = "success";
} else {
    $response["status"] = "error";
}

echo json_encode($response);