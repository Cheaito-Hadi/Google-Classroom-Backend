<?php

include("connection.php");

$received_email = $_POST["email"];

$query = $mysqli->prepare('select * from users where email=?');
$query->bind_param('s', $received_email);
$query->execute();

$query->store_result();

$num_rows = $query->num_rows();
if ($num_rows == 0) {
    $response['status'] = "user not found";
} else {
    $response['status'] = "next step";
}
echo json_encode($response);
