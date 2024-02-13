<?php
session_start();
include ('../config/conn.php');
$error = '';

$leader_id = $_POST['leader_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$url = $_POST['url'];
$query = "select * from social_media where title='$title' and leader_id='$leader_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==0){
    if($_FILES['image']['name'] != '')
    {
        $allowed_extension = array('avif','png','PNG','JPG','jpg','JPEG','.JPEG');
        $file_array = explode(".", $_FILES["image"]["name"]);
        $extension = end($file_array);
        if(in_array($extension, $allowed_extension)){

            $filename   = uniqid() . "-profile-image-" . time();
            $basename   = $filename . "." . $extension; 
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type']; 
            $file = "../uploads/{$basename}";  
            move_uploaded_file($_FILES['image']['tmp_name'],$file);

            $query = "INSERT INTO social_media (leader_id,title,url,image,description)
            VALUES ('$leader_id','$title','$url','$basename','$description')
            ";
            $result = mysqli_query($conn,$query);
            $response->error = "";
            $response->message = "Blog added successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }
  
}else{
    $response->error = "This Blog already exists";
}
echo json_encode($response);  