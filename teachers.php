<?php

include('connection.php');

$class_room_id =1;

$query = $mysqli->prepare('select first_name, last_name from users u join teachers t on u.id = t.teacher_id where t.classRoom_id_teacher = ?');
$query->bind_param("i",$class_room_id);
$query->execute();
$array = $query->get_result();
$response =[];

while($teacher = $array->fetch_assoc()){
    $response[] = $teacher;
}
echo json_encode($response);


