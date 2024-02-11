<?php
session_start();
include ('../config/conn.php');
$error = '';

$leader_id = $_POST['leader_id'];
$label = $_POST['label'];
$value = $_POST['value'];
$query = "select * from voters_label where label='$label' OR value='$value' AND leader_id='$leader_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==0){
    $query = "INSERT INTO voters_label (leader_id,label,value)
    VALUES ('$leader_id','$label','$value')
    ";
    $result = mysqli_query($conn,$query);
    $response->error = "";
    $response->message = "Label Value added successfully.";
}else{
    $response->error = "This label or value already exists";
}
echo json_encode($response);  