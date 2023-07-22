<?php

include('connection.php');

$user_id =1;

$query = $sql->prepare('select teacher_id from teachers where classRoom_id_teacher = ?');
$query->bind_param("i",$user_id);
$query->execute();
$array = $query->get_result();
$response =[];

while($teacher = $array->fetch_assoc()){
    $response[] = $teacher;
}
foreach($response as $teacher){
    $id = $teacher['teacher_id'];
    $teacher_info = $sql->prepare('select first_name, last_name from users where id = ?');
    $teacher_info->bind_param("i",$id);
    $teacher_info->execute();
    $array_of_teachers =  $teacher_info->get_result();
    $teacher_response =[];
    while($teacher_result = $array_of_teachers->fetch_assoc()){
        $teacher_response[] = $teacher_result;
    }
    echo json_encode($teacher_response);
}


