<?php

include('connection.php');

$class_room_id =1;

$query = $sql->prepare('select user_id from students where id_classRoom = ?');
$query->bind_param("i",$class_room_id);
$query->execute();
$array = $query->get_result();
$response =[];

while($student = $array->fetch_assoc()){
    $response[] = $student;
}
foreach($response as $student){
    $id = $student['user_id'];
    $student_info = $sql->prepare('select first_name, last_name from users where id = ?');
    $student_info->bind_param("i",$id);
    $student_info->execute();
    $array_of_students =  $student_info->get_result();
    $student_response =[];
    while($student_result = $array_of_students->fetch_assoc()){
        $student_response[] = $student_result;
    }
    echo json_encode($student_response);
}

