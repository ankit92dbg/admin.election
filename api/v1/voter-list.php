<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');
$leader_id = $_POST['leader_id'];
$record_per_page = 100;
$page = '';
if(isset($_POST["page"]))  
{  
     $page = $_POST["page"]; 
}  
else  
{  
     $page = 1;  
} 
$start_from = ($page - 1)*$record_per_page;  
$query = "select * from voters_data where leader_id='$leader_id' ORDER BY id ASC LIMIT $start_from, $record_per_page";
$result = mysqli_query($conn,$query);

$query2 = "select * from voters_data where leader_id='$leader_id' ORDER BY id ASC";
$result2 = mysqli_query($conn,$query2);
$total_pages = ceil(mysqli_num_rows($result2)/$record_per_page);  

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
$response->current_page = $page;
$response->total_page = $total_pages;
$response->data = $data;
echo json_encode($response);
?>