<?php
include('connection.php');

$instructions = $_POST["instructions"];
$title = $_POST["title"];
$topic = $_POST["topic"];
$date = $_POST["due_date"];

$query = $mysqli->prepare("INSERT INTO assignmnt(instarction, title) VALUES (?,?)");
$query->bind_param("ss", $instructions, $title);
$queryResult = $query->execute();

if ($queryResult) {
    $response["status"] = "success!";
    $response["message"] = "Inserted successfully!";
} else {
    $response["status"] = "failed";
    $response["message"] = "Insertion failed";
}

echo json_encode($response);