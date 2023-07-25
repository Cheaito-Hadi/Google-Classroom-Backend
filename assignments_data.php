<?php

include('connection.php');

$classroom_id =2;

$query = $sql->prepare('SELECT a.title, a.instarction, DATE_FORMAT(a.due_date, "%b %e %h:%i %p") as due_date, DATE_FORMAT(a.post_date, "%b %e") as post_date, u.first_name, u.last_name FROM assignmnt a JOIN teachers t ON a.teachers_id = t.id JOIN users u ON t.teacher_id = u.id WHERE a.id = ?');
$query->bind_param("i",$classroom_id);

$query->execute();
$array = $query->get_result();
$response =[];

while($assignment = $array->fetch_assoc()){
    $response[] = $assignment;
}
echo json_encode($response);


