<?php
include('connection.php');

$recovery_email = $_POST["email"];

$query = $mysqli->prepare("SELECT password from users where email = ?");
$query->bind_param("s",$recovery_email);
$query->execute();

$query->store_result();

$num_rows = $query->num_rows;

$data = array();
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);