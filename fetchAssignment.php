<?php

include('connection.php');

if(isset($_POST['class_room_id'])) {
    $id = $_POST['class_room_id'];

    $query = $mysqli->prepare('SELECT title, due_date FROM assignments WHERE class_room_id = ?');
    $query->bind_param('i', $id);
    $query->execute();
    $query->store_result();
    $query->bind_result($title, $due_date);

    $class = array();
    while($query->fetch()) {
        $assignment = array(
            'title' => $title,
            'due_date' => $due_date
        );
        $class[] = $assignment;
    }

    $response = array();
    $response['class'] = $class;

    echo json_encode($response);
} else {
    echo "Classroom ID not set";
}
