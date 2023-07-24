<?php

include('../connection.php');

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $class_id = $_POST['id_classRoom'];

    $check_user = $mysqli->prepare('SELECT * FROM Students WHERE id_classRoom = ? AND user_id = ?');
    $check_user->bind_param('ss', $class_id, $user_id);
    $check_user->execute();
    $check_user->store_result();
    $join_exists = $check_user->num_rows();

    if ($join_exists == 0) {
        $query = $mysqli->prepare('INSERT INTO Students (id_classRoom, user_id) VALUES (?, ?)');
        $query->bind_param('ss', $class_id, $user_id);
        $query->execute();
        $response['status'] = 'success';
        $response['message'] = 'you just joined the class';
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'already joined the class';
    }
} else {
    $response['status'] = 'failed';
    $response['message'] = 'no user found';
}

$json_response = json_encode($response);
echo $json_response;
