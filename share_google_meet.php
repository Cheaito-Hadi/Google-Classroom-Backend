<?php

include('../connection.php');

$google_link = $_POST['google_link'];
$classroom_name = $_POST['name'];
$check_name = $mysqli->prepare('SELECT name FROM class_room WHERE name=?');
$check_name->bind_param('s', $classroom_name);
$check_name->execute();
$check_name->store_result();
$name_exists = $check_name->num_rows();

if ($name_exists > 0) {
    $query = $mysqli->prepare('UPDATE class_room SET google_link=? WHERE name=?');
    $query->bind_param('ss', $google_link, $classroom_name);
    $query->execute();
} else {
    $response['status'] = "failed";
    echo json_encode($response);
}

$response['status'] = "success";
echo json_encode($response);
?>

