<?php

include('../connection.php');


if (isset($_POST['name'])) {
    $classroom_name = $_POST['name'];
    $check_name = $mysqli->prepare('SELECT name FROM class_room WHERE name=?');
    $check_name->bind_param('s', $classroom_name);
    $check_name->execute();
    $check_name->store_result();
    $name_exists = $check_name->num_rows();
    
    if ($name_exists == 0) {
        $query = $mysqli->prepare('INSERT into class_room (id,name) values(?)');
        $query->bind_param('s', $classroom_name);
        $query->execute();
    
        $response['status'] = "class Room is created";
    } else {
        $response['status'] = "failed to create class Room";
    }
    
    echo json_encode($response);
} else {
     $response['status'] = "please enter class room name";
     echo json_encode($response);
    }

?>