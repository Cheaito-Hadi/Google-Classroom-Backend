<?php 

include('connection.php');

$role=$_POST['role'];
$query=$mysqli->prepare('SELECT email from users WHERE role=?');
$query->bind_param('s',$role);
$query->execute();
$query->store_result();
$query->bind_result($email);
$students_exists = $query->num_rows();

if($students_exists == 0){

    $response['status'] = "No student";
    echo json_encode($response);

}else{
    $emails = array(); 

    while ($query->fetch()) {
        $emails[] = $email; 
    }   
    $response = array();
    $response['emails']=$emails;
    echo json_encode($response);

}