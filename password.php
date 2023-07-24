<?php
include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $mysqli->prepare('SELECT * FROM users WHERE email = ?');
$query->bind_param('s', $email);
$query->execute();

$result = $query->get_result();
$response = array();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {

        $response['status'] = 'logged in';
        $response['user'] = $user;
    } else {
        $response['status'] = "wrong password";
    }
} else {
    $response['status'] = "user not found";
}

echo json_encode($response);
