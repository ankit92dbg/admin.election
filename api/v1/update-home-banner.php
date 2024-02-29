<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');
$user_id = $_POST['user_id'];
$response = new stdClass();
if($_FILES['banner_image']['name'] != '')
    {
        $allowed_extension = array('avif','png','PNG','JPG','jpg','JPEG','.JPEG');
        $file_array = explode(".", $_FILES["banner_image"]["name"]);
        $extension = end($file_array);
        if(in_array($extension, $allowed_extension)){

            $filename   = uniqid() . "-banner-image-" . time();
            $basename   = $filename . "." . $extension; 
            $file_name = $_FILES['banner_image']['name'];
            $file_size =$_FILES['banner_image']['size'];
            $file_tmp =$_FILES['banner_image']['tmp_name'];
            $file_type=$_FILES['banner_image']['type']; 
            $file = "../../uploads/{$basename}";  
            move_uploaded_file($_FILES['banner_image']['tmp_name'],$file);

            $query = "UPDATE `user_tbl` SET `home_banner`='$basename'
            WHERE `id`='$user_id'";
            $result = mysqli_query($conn,$query);




            $response->error = "";
            $response->message = "Banner Image updated successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }


echo json_encode($response);
?>