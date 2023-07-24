<?php

include('../connection.php');

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $class_id = $_POST['id_classRoom'];

    $check_user = $mysqli->prepare('SELECT * FROM Students WHERE id_classRoom = ? AND user_id = ?');
    $check_user->bind_param('ss', $class_id, $user_id);
    $check_user->execute();
    $check_user->store_result();
    $join_exists = $check_user->num_rows();

    if ($join_exists == 0) {
        $query = $mysqli->prepare('INSERT INTO Students (id_classRoom, user_id) VALUES (?, ?)');
        $query->bind_param('ss', $class_id, $user_id);
        $query->execute();

        $get_student = $mysqli->prepare('SELECT * FROM Students WHERE user_id = ?');
        $get_student->bind_param('s', $user_id);
        $get_student->execute();
        $get_student->store_result();
        $get_student->bind_result($student_id, $classRoom_id, $user_id);
    
        $student_array = array();
        
        while ($get_student->fetch()) {
            $student_row = array(
                'student_id' => $student_id,
                'classRoom_id' =>  $classRoom_id,
                'user_id' =>$user_id,
            );
            
            $student_array[] = $student_row;
        }

        $response['status'] = 'success';
        $response['message'] = 'you just joined the class';
        $response['student'] = $student_array;
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'already joined the class';
    }

} else {
    $response['status'] = 'failed';
    $response['message'] = 'no user found';
}

$json_response = json_encode($response);
echo $json_response;
