<?php

include('../connection.php');

// Allow the following HTTP headers for CORS requests, including the Content-Type header.
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

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
    
        $response['status'] = "success";
    } else {
        $response['status'] = "failed";
    }
    
    echo json_encode($response);
} else {
     $response['status'] = "no name";
     echo json_encode($response);
    }

?>