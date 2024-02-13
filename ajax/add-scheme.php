<?php
session_start();
include ('../config/conn.php');
$error = '';

$leader_id = $_POST['leader_id'];
$scheme = $_POST['scheme'];
$type = $_POST['type'];
$query = "select * from labharthi_scheme where scheme_name='$scheme' AND scheme_type='$type' AND leader_id='$leader_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==0){
    $query = "INSERT INTO labharthi_scheme (scheme_type,scheme_name,leader_id)
    VALUES ('$type','$scheme','$leader_id')
    ";
    $result = mysqli_query($conn,$query);
    $response->error = "";
    $response->message = "Scheme added successfully.";
}else{
    $response->error = "This scheme already exists";
}
echo json_encode($response);  