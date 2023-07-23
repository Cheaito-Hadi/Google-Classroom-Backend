<?php

include("connection.php");

$email=$_POST["email"];

$query = $mysqli->prepare('select * from users where email=?');
$query->bind_param('s', $email);
$query->execute();

$query->store_result();
$query->bind_result($id, $first_name, $last_name, $email);
$query->fetch();

$num_rows = $query->num_rows();
$response = array()
if ($num_rows == 0) {
    $response['status'] = "user not found";
} else {
    $response['status'] = "next step";
}
echo json_encode($response);
