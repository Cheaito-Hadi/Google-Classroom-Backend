<?php
include('connection.php');

if (isset($_POST['name'])) {
    $user_id=$_POST['user-id'];
    $name = $_POST['name'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $room = $_POST['room']; 

    $check_name = $mysqli->prepare('SELECT name FROM classes_room WHERE name=?');
    $check_name->bind_param('s', $name);
    $check_name->execute();
    $check_name->store_result();
    $name_exists = $check_name->num_rows();
    
    if ($name_exists == 0) {
        $query = $mysqli->prepare('INSERT into classes_room (name,section,subject,room) values(?,?,?,?)');
        $query->bind_param('ssss', $name,$section,$subject,$room);
        $query->execute();
        
        $get_id = $mysqli->prepare('SELECT id FROM classes_room Where name=?');
        $get_id->bind_param('s', $name);
        $get_id->execute();
        $get_id->store_result();
        $get_id->bind_result($id_classroom);
        $get_id->fetch();

        $add_teacher=$mysqli->prepare('INSERT into teachers (user_id , classRoom_id) values(?,?)');
        $add_teacher->bind_param('ss', $user_id,$id_classroom);
        $add_teacher->execute();

        $get_teachers=$mysqli->prepare('SELECT * from teachers Where user_id=?');
        $get_teachers->bind_param('s', $user_id);
        $get_teachers->execute();
        $get_teachers->store_result();
        $get_teachers->bind_result($id,$user_id,$classRoom_id_teacher);

        while ($get_teachers->fetch()) {
        $teacher_data = array(
           'id' => $id,
           'user_id' => $user_id,
           'classRoom_id'=>$classRoom_id_teacher,
           );
           $all_teacher_data[] = $teacher_data;
        }

       $get_classes = $mysqli->prepare('SELECT * FROM classes_room');
       $get_classes->execute();
       $get_classes->store_result();
       $get_classes->bind_result($id_classroom, $name,$google_link, $section, $subject, $room, $image);

      $classes_array = array();

      while ($get_classes->fetch()) {
      $class_data = array(
        'id' => $id_classroom,
        'name' => $name,
        'google_link'=>$google_link,
        'section' => $section,
        'subject' => $subject,
        'room'=>$room,
    );
    $classes_array[] = $class_data;
    }

    $response['status'] = "class Room is created you have been add to teacher group";
    $response['classes']=$classes_array;
    $response['teacher']=$all_teacher_data;
    } else {
        $response['status'] = "failed to create class Room";
    }

    echo json_encode($response);

} else {
     $response['status'] = "please enter class room name";
     echo json_encode($response);
    }

?>