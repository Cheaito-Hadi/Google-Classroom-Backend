<?php

include('connection.php');

$title = $_POST['title'];
$instruction = $_POST['instruction'];
$date = date('Y-m-d\TH:i:s', strtotime($_POST['due_date']));

$query = $sql->prepare('insert into assignments(title, instruction, due_date) values (?,?,?)');

$query->bind_param('sss', $title,$instruction,$date);
$query->execute();

