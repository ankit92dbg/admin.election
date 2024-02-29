<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');
$leader_id = $_POST['leader_id'];
$query = "select * from user_tbl where leader_id='$leader_id'";
$result = mysqli_query($conn,$query);

$response = new stdClass();
$data = [];
$i=0;
while($row = mysqli_fetch_assoc($result)){
    $data[$i] = $row;
    $i++;
}
if(count($data)>0){
    $response->message = "success";
}else{
    $response->message = "fail";
}
$response->data = $data;
echo json_encode($response);
?>