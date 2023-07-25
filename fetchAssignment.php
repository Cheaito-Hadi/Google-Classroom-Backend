<?php

include('connection.php');

if(isset($_POST['class_room_id'])) {
    $id = $_POST['class_room_id'];

    $query = $mysqli->prepare('SELECT id,title, due_date,topic FROM assignments WHERE class_room_id = ?');
    $query->bind_param('i', $id);
    $query->execute();
    $query->store_result();
    $query->bind_result($id,$title, $due_date,$topic);

    $assignemnts = array();
    while($query->fetch()) {
        $assignment_data = array(
            'id' => $id,
            'title' => $title,
            'due_date' => $due_date,
            'topic' => $topic,
        );
        $assignemnts[] = $assignment_data;
    }

    $response = array();
    $response['assignemnts'] = $assignemnts;

    echo json_encode($response);
} else {
    echo "Classroom ID not set";
}
