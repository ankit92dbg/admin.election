<?php
session_start();
include ('../config/conn.php');
$error = '';

$leader_id = $_POST['leader_id'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
//$SECTION_NO = $_POST['SECTION_NO'];
$SECTION_NO_FROM = $_POST['SECTION_NO_FROM'];
$SECTION_NO_TO = $_POST['SECTION_NO_TO'];
$SEC_VAL = $_POST['SEC_VAL'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
$age = $_POST['age'];
$category = $_POST['category'];
$designation = $_POST['designation'];
$city = $_POST['city'];
$state = $_POST['state'];
$address = $_POST['address'];
$profile_image = $_POST['profile_image'];
$user_type = 2;
$query = "select * from user_tbl where email='$email' or phone='$phone'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==0){

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

            $query = "INSERT INTO user_tbl (leader_id,f_name,l_name,email,phone,password,age,designation,city,state,address,profile_image,category,user_type)
            VALUES ('$leader_id','$f_name','$l_name','$email','$phone','$password','$age','$designation','$city','$state','$address','$basename','$category','$user_type')
            ";
            $result = mysqli_query($conn,$query);

            //insert booth
            $queryCheck = "select * from user_tbl order by id desc";
            $resultCheck = mysqli_query($conn,$queryCheck);
            $rowsCheck = mysqli_fetch_assoc($resultCheck);
            $insert_id = $rowsCheck['id'];
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
                                    $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$insert_id','$j')";
                                    mysqli_query($conn,$boothQuery);                        
                            }
                        }
    
                    }
                   
                }
            }




            $response->error = "";
            $response->message = "BM added successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }else{
        $query = "INSERT INTO user_tbl (leader_id,f_name,l_name,email,phone,password,age,designation,city,state,address,category,user_type)
            VALUES ('$leader_id','$f_name','$l_name','$email','$phone','$password','$age','$designation','$city','$state','$address','$category','$user_type')
            ";
        $result = mysqli_query($conn,$query);

        //insert booth
        $queryCheck = "select * from user_tbl order by id desc";
        $resultCheck = mysqli_query($conn,$queryCheck);
        $rowsCheck = mysqli_fetch_assoc($resultCheck);
        $insert_id = $rowsCheck['id'];
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
                                    $boothQuery = "INSERT INTO user_assigned_booth (user_id,SECTION_NO) VALUES ('$insert_id','$j')";
                                    mysqli_query($conn,$boothQuery);                        
                            }
                        }
    
                    }
                   
                }
            }

        


        $response->error = "";
        $response->message = "BM added successfully.";
    }


    
}else{
    $response->error = "BM already exists! Please use unique email id and mobile no.";
}
echo json_encode($response);
?>