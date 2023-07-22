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
        $query = $mysqli->prepare('INSERT into class_room (name) values(?)');
        $query->bind_param('s', $classroom_name);
        $query->execute();
        
        $get_id = $mysqli->prepare('SELECT id FROM class_room Where name=?');
        $get_id->bind_param('s', $classroom_name);
        $get_id->execute();
        $get_id->store_result();
        $get_id->bind_result($id);
        $get_id->fetch();

        $response['status'] = "class Room is created";
        $response['id']=$id;
    } else {
        $response['status'] = "failed to create class Room";
    }
    echo json_encode($response);

} else {
     $response['status'] = "please enter class room name";
     echo json_encode($response);
    }

?>