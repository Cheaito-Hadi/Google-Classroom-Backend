<?php
include('connection.php');

$class_room_id = $_POST["classroom_id"];

$query = $mysqli->prepare("SELECT id,title,teachers_id,class_room_id FROM assignments where class_room_id=?");
$query->bind_param('s',$class_room_id);
$query->execute();
$query->store_result();
$query->bind_result($id,$title,$teachers_id,$class_room_id);

$assignment = array();
while ($query->fetch()) {
    $assignment_data= array(
        'id' => $id,
        'title' => $title,
        'teachers_id' => $teachers_id,
        'class_room_id' => $class_room_id,
    );

$assignment[] = $assignment_data;
}
$response['status'] = "Display assignments";
$response['assignment']=$assignment;

echo json_encode($response);
?>