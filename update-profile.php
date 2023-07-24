<?php
include('connection.php');

if(isset($_POST['first-name'])){
    $update_firstname = $_POST['first-name'];
}else{
    $update_firstname = "";
}
if(isset($_POST['last-name'])){
    $update_lastname = $_POST['last-name'];
}else{
    $update_lastname='';
}
if(isset($_POST['email'])){
    $update_email = $_POST['email'];
}else{
    $update_email='';
}
if(isset( $_POST['password'])){
    $update_password = $_POST['password'];
}else{
    $upload_password='';
}


$user_id = $_POST['user_id'];

$update_query = "UPDATE users SET ";

$update_fields = array();
if ($update_firstname !== "") {
    $update_fields[] = "first_name = '$update_firstname'";
}
if ($update_lastname !== "") {
    $update_fields[] = "last_name = '$update_lastname'";
}
if ($update_email !== "") {
    $update_fields[] = "email = '$update_email'";
}
if ($upload_password !== "") {
    $hashed_password = password_hash($update_password, PASSWORD_BCRYPT);
    $update_fields[] = "hashed_password = '$hashed_password'";
}

$update_query .= implode(", ", $update_fields);

$update_query .= " WHERE id = '$user_id'";

if ($mysqli->query($update_query)) {
    $response['status'] = 'success';
    $response['message'] = 'User information updated successfully';
} else {
    $response['status'] = 'failed';
    $response['message'] = 'Failed to update user information';
}

echo json_encode($response);
?>
