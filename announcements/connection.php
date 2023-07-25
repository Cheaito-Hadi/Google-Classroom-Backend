<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 3600');
$host = "localhost";
$db_user = "root";
$db_pass = null;
$db_name = "mydb";
$mysqli = new mysqli("localhost", "root", null, "mydb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
