<?php
session_start();
include ('../config/conn.php');
$error = '';

$user_id = $_POST['user_id'];
// $AC_NO = $_POST['AC_NO'];
// $PART_NO = $_POST['PART_NO'];
$assembly_name = $_POST['assembly_name'];
// $SECTION_NO = $_POST['SECTION_NO'];
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
$query = "select * from user_tbl where email='$email'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==1 && $row['id']!=$user_id){
    $response->error = "Candidate email already exists in our system, please try with different EmailId.";
    $response->message = "Candidate email already exists in our system, please try with different EmailId.";
}else{
    if($_POST['password']!=""){
        $password = md5($_POST['password']);
    }else{
        $password = $row['password'];
    }

    //delete old booth
    // $boothQuery = "DELETE from user_assigned_booth WHERE user_id='$user_id'";
    // mysqli_query($conn,$boothQuery);

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

            $query = "UPDATE `user_tbl` SET `assembly_name`='$assembly_name',`email`='$email',`phone`='$phone',`f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password',`profile_image`='$basename'
            WHERE `id`='$user_id'";
            $result = mysqli_query($conn,$query);


            //insert booth
            // for($i=0;$i<count($SECTION_NO);$i++){
            //     $newSec = $SECTION_NO[$i];
            //     $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$user_id','$newSec')";
            //     mysqli_query($conn,$boothQuery);
            // }



            $response->error = "";
            $response->message = "Leader updated successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }else{
       $query = "UPDATE `user_tbl` SET `assembly_name`='$assembly_name',`email`='$email',`phone`='$phone',`f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password'
            WHERE `id`='$user_id'";
        $result = mysqli_query($conn,$query);

         //insert booth
        //  $queryCheck = "select * from user_tbl order by id desc";
        //  $resultCheck = mysqli_query($conn,$queryCheck);
        //  $rowsCheck = mysqli_fetch_assoc($resultCheck);
        //  $insert_id = $rowsCheck['id'];
        //  for($i=0;$i<count($SECTION_NO);$i++){
        //      $newSec = $SECTION_NO[$i];
        //      $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$insert_id','$newSec')";
        //      mysqli_query($conn,$boothQuery);
        //  }

        $response->error = "";
        $response->message = "Candidate updated successfully.";
    }


    
}
echo json_encode($response);
?>