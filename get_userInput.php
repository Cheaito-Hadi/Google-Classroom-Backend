<?php
include('connection.php');

$email = $_POST['email'];

$query = $mysqli->prepare('SELECT id,first_name,last_name,email,profile_image FROM users WHERE email = ?');
$query->bind_param('s', $email);
$query->execute();

$result = $query->get_result();
$response = array();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();
    $response['status'] = 'logged in';
    $response['user'] = $user;
} else {
    $response['status'] = "user not found";
}

echo json_encode($response);
