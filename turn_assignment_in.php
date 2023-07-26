<?php

include('connection.php');

$student_id = $_POST['student_id'];
$assignment_id = $_POST['assignment_id'];

$query = $mysqli->prepare('INSERT INTO turned_in ( `student_id`, `assignment_id`) VALUES (?,?)');
$query->bind_param("ii",$student_id,$assignment_id);

if ($query->execute()) {
    echo json_encode(array("message" => "Turned in"));
   } else {
    echo json_encode(array("error" => "Error: " . $q->error));
}