<?php
session_start();
include ('../config/conn.php');
$error = '';

$id = $_POST['id'];
$label = $_POST['label'];
$value = $_POST['value'];
$query = "select * from voters_label where id='$id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==1){
    $query = "UPDATE voters_label SET `label`='$label',`value`='$value'
    WHERE `id`='$id'
    ";
    $result = mysqli_query($conn,$query);
    $response->error = "";
    $response->message = "Label Value updated successfully.";
}else{
    $response->error = "This label or value already exists";
}
echo json_encode($response);  