<?php

include('connection.php');

$class_room_id =1;

$query = $mysqli->prepare('select count(*) as number_of_students from students s where s.classRoom_id = ?');
$query->bind_param("i",$class_room_id);

$query->execute();
$array = $query->get_result();

$student_count = $array->fetch_assoc()['number_of_students'];

echo $student_count;


