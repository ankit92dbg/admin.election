<?php
session_start();
include ('../config/conn.php');
$email = $_POST['email'];
$password = md5($_POST['password']);
$query = "select * from user_tbl where email='$email' and password='$password' and user_type=0";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if($row){
    if($row['isActive']==0){
        $response->message = "Your account is deactive, please contact your admin. Thanks!!";
    }else{
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['f_name'] = $row['f_name'];
        $_SESSION['l_name'] = $row['l_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['leader_id'] = $row['leader_id'];
        $_SESSION['user_type'] = $row['user_type'];
        if($row['user_type']==1){
        $_SESSION['PART_NO'] = $row['PART_NO'];
        }
        if($row['user_type']==0){
            $_SESSION['title'] = "Admin Panel";
        } else if($row['user_type']==1){
            $_SESSION['title'] = "Candidate Panel";
        } else {
            $_SESSION['title'] = "Cader Panel";
        }
        if($row['user_type']==2){
            $query2 = "select * from user_tbl where id='".$row['leader_id']."'";
            $result2 = mysqli_query($conn,$query2);
            $row2 = mysqli_fetch_assoc($result2);
            $_SESSION['PART_NO'] = $row2['PART_NO'];
        }
        $response->message = "success";
        $response->user_type = $row['user_type'];
    }
}else{
    $response->message = "Invalid email or password!";
}
echo json_encode($response);
?>