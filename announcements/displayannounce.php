<?php

include('connectiom.php');

$query = $mysqli->prepare("SELECT title FROM announcemnet");
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