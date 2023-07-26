<?php
include('connection.php');

if (isset($_FILES["profile_image"])) {
    $user_id = $_POST["user_id"];

    $uploadDir = "uploads/";

    $fileName = $_FILES["profile_image"]["name"];
    $tmpName = $_FILES["profile_image"]["tmp_name"];
    $fileSize = $_FILES["profile_image"]["size"];
    $fileError = $_FILES["profile_image"]["error"];

    if ($fileError === UPLOAD_ERR_OK) {
        $uniqueFileName = uniqid() . '_' . $fileName;

        $destination = $uploadDir . $uniqueFileName;
        if (move_uploaded_file($tmpName, $destination)) {

            $stmt = $mysqli->prepare('UPDATE users SET profile_image = ? WHERE id = ?');
            $stmt->bind_param('ss', $destination, $user_id);
            $stmt->execute();

            $response['status'] = 'success';
            $response['message'] = ' image is uploaded';
            $response['image_path'] = $destination;
            $response['id']=$user_id;
        } else {
            $response['status'] = 'failed';
        }
    } else {
        $response['status'] = 'Error failed';
    }

    $json_response = json_encode($response);
    echo $json_response;
}
?>
