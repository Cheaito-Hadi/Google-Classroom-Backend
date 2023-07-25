<?php

include('connection.php');

$class_room_id =1;

$query = $mysqli->prepare('select first_name, last_name from users u join students s on u.id = s.user_id where s.id_classRoom = ?');
$query->bind_param("i",$class_room_id);
$query->execute();
$array = $query->get_result();
$response =[];

while($student = $array->fetch_assoc()){
    $response[] = $student;
}
echo json_encode($response);






