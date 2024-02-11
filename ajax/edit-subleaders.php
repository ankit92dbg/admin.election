<?php
session_start();
include ('../config/conn.php');
$error = '';

$user_id = $_POST['user_id'];
$leader_id = $_POST['leader_id'];
//$SECTION_NO = $_POST['SECTION_NO'];
$SECTION_NO_FROM = $_POST['SECTION_NO_FROM'];
$SECTION_NO_TO = $_POST['SECTION_NO_TO'];
$SEC_VAL = $_POST['SEC_VAL'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = "";
$age = $_POST['age'];
$category = $_POST['category'];
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
    $response->error = "BM email already exists in our system, please try with different EmailId.";
    $response->message = "BM email already exists in our system, please try with different EmailId.";
}else{
    if($_POST['password']!=""){
        $password = md5($_POST['password']);
    }else{
        $password = $row['password'];
    }
 //delete old booth
    $boothQuery = "DELETE from user_assigned_booth WHERE user_id='$user_id'";
    mysqli_query($conn,$boothQuery);

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

            $query = "UPDATE `user_tbl` SET `leader_id`='$leader_id',`email`='$email',`phone`='$phone',`f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`password`='$password',`category`='$category',`profile_image`='$basename'
            WHERE `id`='$user_id'";
            $result = mysqli_query($conn,$query);

            //insert booth
             if($SECTION_NO_FROM!=''){
                for($i=0;$i<count($SECTION_NO_FROM);$i++){
                    $SECTION_NO_FROM_DIFF = $SECTION_NO_FROM[$i];
                    $SECTION_NO_TO_DIFF = $SECTION_NO_TO[$i];
                    if($SECTION_NO_FROM_DIFF < $SECTION_NO_TO_DIFF){
                        $arrSec = [];
                        $l=0;
                        for($j=$SECTION_NO_FROM_DIFF;$j<= $SECTION_NO_TO_DIFF; $j++){                      
                            $arrSec[$l] = $j;
                            $l++;
                        }
                        if (array_intersect($arrSec, explode(',',$SEC_VAL[0]))) {
                            for($j=$SECTION_NO_FROM_DIFF;$j<= $SECTION_NO_TO_DIFF; $j++){                         
                                    $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$user_id','$j')";
                                    mysqli_query($conn,$boothQuery);                        
                            }
                        }
    
                    }
                   
                }
            }



            $response->error = "";
            $response->message = "Cader updated successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }else{
        $query = "UPDATE `user_tbl` SET `leader_id`='$leader_id',`email`='$email',`phone`='$phone',`f_name`='$f_name',`l_name`='$l_name',`email`='$email',
            `age`='$age',`designation`='$designation',`city`='$city',`state`='$state',`address`='$address',`category`='$category',`password`='$password'
            WHERE `id`='$user_id'";
        $result = mysqli_query($conn,$query);

         //insert booth
           if($SECTION_NO_FROM!=''){
                for($i=0;$i<count($SECTION_NO_FROM);$i++){
                    $SECTION_NO_FROM_DIFF = $SECTION_NO_FROM[$i];
                    $SECTION_NO_TO_DIFF = $SECTION_NO_TO[$i];
                    if($SECTION_NO_FROM_DIFF < $SECTION_NO_TO_DIFF){
                        $arrSec = [];
                        $l=0;
                        for($j=$SECTION_NO_FROM_DIFF;$j<= $SECTION_NO_TO_DIFF; $j++){                      
                            $arrSec[$l] = $j;
                            $l++;
                        }
                        if (array_intersect($arrSec, explode(',',$SEC_VAL[0]))) {
                            for($j=$SECTION_NO_FROM_DIFF;$j<= $SECTION_NO_TO_DIFF; $j++){                         
                                    $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$user_id','$j')";
                                    mysqli_query($conn,$boothQuery);                        
                            }
                        }
    
                    }
                   
                }
            }
    

        $response->error = "";
        $response->message = "BM updated successfully.";
    }


    
}
echo json_encode($response);
?>