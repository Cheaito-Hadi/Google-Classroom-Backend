<?php

include ('connection.php');

    $email = $_POST["email"];
    $new_password = $_POST["new_password"];

    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $updateQuery = $mysqli->prepare("UPDATE users SET password = ? WHERE email =?");
    $updateQuery->bind_param("ss", $hashed_password, $email);
    $updateResult = $updateQuery->execute();

    if ($updateResult) {
        $response["status"] = "success";
        $response["message"] = "Password updated successfully!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to update password.";
    }
    echo json_encode($response);