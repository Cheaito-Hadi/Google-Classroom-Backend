<?php
include('connection.php');


//assignment taba3 classroom m3ayyane
$query = $mysqli->prepare("SELECT * FROM assignmnt");
$query->execute();
$query->store_result();
$query->bind_result($title);

$titles = array();
while ($query->fetch()) {
    $titles[] = $title;
}
$response["titles"] = $titles;
echo json_encode($response);
?>
