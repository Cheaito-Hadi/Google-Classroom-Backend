<?php
include('connection.php');

if (isset($_POST['student_id']) && isset($_POST['assignment_id']) && isset($_FILES['fileToUpload'])) {
    $student_id = $_POST['student_id'];
    $assignment_id = $_POST['assignment_id'];
    if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $fileData = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        $query = $sql-> prepare('INSERT INTO assignmnts_uploads (student_id, assignmnt_id, files) VALUES (?, ?, ?)');
        $query->bind_param("iis",$student_id,$assignment_id,$fileData);

        if ($query->execute()) {
         echo json_encode(array("message" => "File uploaded and data inserted successfully."));
        } else {
         echo json_encode(array("error" => "Error: " . $q->error));
        }
    } else {
        echo json_encode(array("error" => "File upload error: " . $_FILES['fileToUpload']['error']));
    }
} else {
    echo json_encode(array("error" => "Missing form data."));
}



