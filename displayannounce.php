<?php

include('connection.php');


$class_room_id = $_POST["classroom_id"];

$query = $mysqli->prepare("SELECT * FROM announcemnets where class_room_id");
$query->execute();
$query->store_result();
$query->bind_result($id,$content,$teacher_id,$files,$create_at,$class_room_id);

$annoucement = array();
while ($query->fetch()) {
    $annoucement_data= array(
        'id' => $id,
        'content' => $content,
        'teacher_id' => $teacher_id,
        'files' => $files,
        'create_at' => $create_at,
        'class_room_id' => $class_room_id,
    );

$annoucement[] = $annoucement_data;
}
$response['status'] = "Display annoucements";
$response['classes']=$annoucement;

echo json_encode($response);
?>