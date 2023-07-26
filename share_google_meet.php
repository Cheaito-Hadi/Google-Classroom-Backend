<?php

include('connection.php');

$google_link = $_POST['google_link'];
$classroom_id = $_POST['classroom_id'];

$query = $mysqli->prepare('UPDATE classes_room SET google_link=? WHERE id=?');
$query->bind_param('ss', $google_link, $classroom_id);
$query->execute();

$response['status'] = "success";
echo json_encode($response);
