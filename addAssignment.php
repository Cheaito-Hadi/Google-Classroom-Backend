<?php

include('connection.php');

$title = $_POST['title'];
$instruction = $_POST['instructions'];
$date = date('Y-m-d\TH:i:s', strtotime($_POST['due_date']));
$topic = $_POST['topic'];
$teacher = $_POST['teachers_id'];
$classroom = $_POST['class_room_id'];

$query = $mysqli->prepare('insert into assignments (title, instructions,due_date,topic,teachers_id,class_room_id) values (?,?,?,?,?,?)');

$query->bind_param('ssssss', $title,$instruction,$date,$topic,$teacher,$classroom);
$query->execute();

$response['status'] = 'assignment created';


$json_response = json_encode($response);
echo $json_response;
