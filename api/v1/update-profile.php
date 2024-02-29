<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');
$user_id = $_POST['user_id'];
$response = new stdClass();
$error = '';

$user_id = $_POST['user_id'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = "";
$age = $_POST['age'];
$designation = $_POST['designation'];
$assembly_name = $_POST['assembly_name'];
$city = $_POST['city'];
$state = $_POST['state'];
$address = $_POST['address'];
$profile_image = $_POST['profile_image'];
$user_type = $_POST['user_type'];
$query = "select * from user_tbl where email='$email'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==1 && $row['id']!=$user_id){
    $response->error = "Email already exists in our system, please try with different EmailId.";
    $response->message = "Email already exists in our system, please try with different EmailId.";
}else{
    if($_POST['password']!=""){
        $password = md5($_POST['password']);
    }else{
        $password = $row['password'];
    }
    $query = "UPDATE `user_tbl` SET `assembly_name`='$assembly_name',`email`='$email',`phone`='$phone',`f_name`='$f_name',`l_name`='$l_name',`email`='$email',
    `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password'
    WHERE `id`='$user_id'";
    $result = mysqli_query($conn,$query);   


    
}
$result = mysqli_query($conn,$query);
$response->error = "";
$response->message = "Profile updated successfully.";
echo json_encode($response);
?>