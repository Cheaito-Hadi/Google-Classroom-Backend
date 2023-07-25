<?php

include('../connection.php');

$get_classes = $mysqli->prepare('SELECT * FROM class_room');
$get_classes->execute();
$get_classes->store_result();
$rows_classes = $get_classes->num_rows();

$response = array(); 

if ($rows_classes !== 0) {
    $get_classes->bind_result($id_classroom, $name, $google_link, $section, $subject, $room, $image);
    
    $classes_array = array();
    
    while ($get_classes->fetch()) {
        $class_data = array(
            'id_classroom' => $id_classroom,
            'class_name' => $name,
            'google-link' => $google_link,
            'section' => $section,
            'subject' => $subject,
            'room' => $room,
            'image' => $image,
        );
        
        $classes_array[] = $class_data;
    }
    
    $response['status'] = 'success'; 
    $response['classes'] = $classes_array;
} else {
    $response['status'] = 'failed';
}

$json_response = json_encode($response);

echo $json_response;
