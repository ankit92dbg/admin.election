<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');
$user_id = $_POST['user_id'];
$query = "select * from user_tbl where id='$user_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if($row){
    if($row['isActive']==0){
        $response->message = "Your account is deactive, please contact your admin. Thanks!!";
    }else{
        $response->data = $row;
        $response->message = "success";
    }
}else{
    $response->message = "Invalid email or password!";
}
echo json_encode($response);
?>