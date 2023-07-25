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
    $new_password = $_POST["new_password"];

    $updateQuery = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ? AND questions = ?");
    $updateQuery->bind_param("sss", $new_password, $recovery_email, $recovery_answer);
    $updateResult = $updateQuery->execute();

    if ($updateResult) {
        $response["status"] = "success";
        $response["message"] = "Password updated successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to update password.";
    }
} else {
    $response["status"] = "error";
    $response["message"] = "User not found with the provided email and security answer.";
}

echo json_encode($response);