<?php
include('connection.php');

$teacher_id = $_POST["teacher_id"];
$announce_title = $_POST["title"];
$announce_text = $_POST["announcement"];
$files = $_POST["files"];
$classroom_id = $_POST["classroom_id"];

$query = $mysqli->prepare("INSERT INTO announcemnet(title,content) VALUES(?,?)");
$query->bind_param("ss", $announce_title,$announce_text);
$queryResult = $query->execute();

if ($queryResult) {
    $response["status"] = "success!";
    $response["message"] = "Inserted successfully!";
} else {
    $response["status"] = "failed";
    $response["message"] = "Insertion failed";
}

echo json_encode($response);

