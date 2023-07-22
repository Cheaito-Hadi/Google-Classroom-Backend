<?php 

include('../connection.php');

$role=$_GET['student'];
$query=$mysqli->prepare('SELECT email from user WHERE role=?');
$query->blind_param('s',$role);
$query->execute();
$query->store_result();
$students_exists = $query->num_rows();

if($students_exists == 0){
    $response['status'] = "success";

}

