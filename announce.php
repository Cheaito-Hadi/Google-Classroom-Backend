<?php
include('connection.php');

$teacher_id = $_POST["teacher_id"];
$announce_text = $_POST["announcement"];
if (isset($_POST["files"])){
$files = $_POST["files"];
}
else{
    $files = null;
}
$classroom_id = $_POST["class_room_id"];

$query = $mysqli->prepare("INSERT INTO announcemnets (teacher_id, class_room_id, content,files) VALUES(?,?,?,?)");
$query->bind_param("ssss",$teacher_id,$classroom_id,$announce_text,$files );
$queryResult = $query->execute();

if ($queryResult) {
    $response["status"] = "success!";
    $response["message"] = "Inserted successfully!";
} else {
    $response["status"] = "failed";
    $response["message"] = "Insertion failed";
}

echo json_encode($response);

