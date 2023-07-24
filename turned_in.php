<?php

include('connection.php');

$assignment_id =2;
$student_id =2;

$query = $sql->prepare('SELECT COUNT(*) as turned_in from turned_in t where t.student_id =? and t.assignment_id =?');
$query->bind_param("ii",$student_id,$assignment_id);

$query->execute();
$array = $query->get_result();

$student_count = $array->fetch_assoc()['turned_in'];

echo $student_count;


