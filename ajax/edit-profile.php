<?php
session_start();
include ('../config/conn.php');
$error = '';

$user_id = $_POST['user_id'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = "";
$age = $_POST['age'];
$designation = $_POST['designation'];
$city = $_POST['city'];
$state = $_POST['state'];
$address = $_POST['address'];
$profile_image = $_POST['profile_image'];
$user_type = 1;
$query = "select * from user_tbl where email='$email' or phone='$phone'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==1){
    if($_POST['password']!=""){
        $password = md5($_POST['password']);
    }else{
        $password = $row['password'];
    }


    if($_FILES['profile_image']['name'] != '')
    {
        $allowed_extension = array('avif','png','PNG','JPG','jpg','JPEG','.JPEG');
        $file_array = explode(".", $_FILES["profile_image"]["name"]);
        $extension = end($file_array);
        if(in_array($extension, $allowed_extension)){

            $filename   = uniqid() . "-profile-image-" . time();
            $basename   = $filename . "." . $extension; 
            $file_name = $_FILES['profile_image']['name'];
            $file_size =$_FILES['profile_image']['size'];
            $file_tmp =$_FILES['profile_image']['tmp_name'];
            $file_type=$_FILES['profile_image']['type']; 
            $file = "../uploads/{$basename}";  
            move_uploaded_file($_FILES['profile_image']['tmp_name'],$file);

            $query = "UPDATE `user_tbl` SET `f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password',`profile_image`='$basename'
            WHERE `id`='$user_id'";
            $result = mysqli_query($conn,$query);




            $response->error = "";
            $response->message = "Profile updated successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }else{
        $query = "UPDATE `user_tbl` SET `f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password'
            WHERE `id`='$user_id'";
        $result = mysqli_query($conn,$query);

    

        $response->error = "";
        $response->message = "Profile updated successfully.";
    }


    
}else{
    $response->error = "User not found!";
}
echo json_encode($response);
?>