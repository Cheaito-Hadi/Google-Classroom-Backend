<?php
include('connection.php');

$recovery_email = $_POST["email"];
$recovery_answer = $_POST["answer"];

$query = $mysqli->prepare("SELECT password FROM users WHERE email = ? AND questions = ?");
$query->bind_param("ss",$recovery_email,$recovery_answer);
$query->execute();

$query->store_result();

$num_rows = $query->num_rows;

$data = array();
if ($query->num_rows > 0) {
    while ($row = $query-> fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);