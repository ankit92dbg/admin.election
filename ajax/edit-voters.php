<?php
session_start();
include ('../config/conn.php');
$error = '';
$voter_id = $_POST['user_id'];
$AC_NO = $_POST['AC_NO'];
$PART_NO = $_POST['PART_NO'];
$SECTION_NO = $_POST['SECTION_NO'];
$SLNOINPART = $_POST['SLNOINPART'];
$C_HOUSE_NO = ($_POST['C_HOUSE_NO']=='') ? NULL : $_POST['C_HOUSE_NO'];
$C_HOUSE_NO_V1 = ($_POST['C_HOUSE_NO_V1']=='') ? NULL : $_POST['C_HOUSE_NO_V1'];
$FM_NAME_EN = ($_POST['FM_NAME_EN']=='') ? NULL : $_POST['FM_NAME_EN'];
$LASTNAME_EN = ($_POST['LASTNAME_EN']=='') ? NULL : $_POST['LASTNAME_EN'];
$FM_NAME_V1 = ($_POST['FM_NAME_V1']=='') ? NULL : $_POST['FM_NAME_V1'];
$LASTNAME_V1 = ($_POST['LASTNAME_V1']=='') ? NULL : $_POST['LASTNAME_V1'];
$RLN_TYPE = ($_POST['RLN_TYPE']=='') ? NULL : $_POST['RLN_TYPE'];
$RLN_FM_NM_EN = ($_POST['RLN_FM_NM_EN']=='') ? NULL : $_POST['RLN_FM_NM_EN'];
$RLN_L_NM_EN = ($_POST['RLN_L_NM_EN']=='') ? NULL : $_POST['RLN_L_NM_EN'];
$RLN_FM_NM_V1 = ($_POST['RLN_FM_NM_V1']=='') ? NULL : $_POST['RLN_FM_NM_V1'];
$RLN_L_NM_V1 = ($_POST['RLN_L_NM_V1']=='') ? NULL : $_POST['RLN_L_NM_V1'];
$EPIC_NO = ($_POST['EPIC_NO']=='') ? NULL : $_POST['EPIC_NO'];
$GENDER = ($_POST['GENDER']=='') ? NULL : $_POST['GENDER'];
$AGE = ($_POST['AGE']=='') ? NULL : $_POST['AGE'];
$DOB = ($_POST['DOB']=='') ? NULL : $_POST['DOB'];
$MOBILE_NO = ($_POST['MOBILE_NO']=='') ? NULL : $_POST['MOBILE_NO'];
$AC_NAME_EN = ($_POST['AC_NAME_EN']=='') ? NULL : $_POST['AC_NAME_EN'];
$AC_NAME_V1 = ($_POST['AC_NAME_V1']=='') ? NULL : $_POST['AC_NAME_V1'];
$SECTION_NAME_EN = ($_POST['SECTION_NAME_EN']=='') ? NULL : $_POST['SECTION_NAME_EN'];
$SECTION_NAME_V1 = ($_POST['SECTION_NAME_V1']=='') ? NULL : $_POST['SECTION_NAME_V1'];
$PSBUILDING_NAME_EN =( $_POST['PSBUILDING_NAME_EN']=='') ? NULL : $_POST['PSBUILDING_NAME_EN'];
$PSBUILDING_NAME_V1 = ($_POST['PSBUILDING_NAME_V1']=='') ? NULL : $_POST['PSBUILDING_NAME_V1'];
$PART_NAME_EN = ($_POST['PART_NAME_EN']=='') ? NULL : $_POST['PART_NAME_EN'];
$PART_NAME_V1 = ($_POST['PART_NAME_V1']=='') ? NULL : $_POST['PART_NAME_V1'];
$aadhar = ($_POST['aadhar']=='') ? NULL : $_POST['aadhar'];
$RELATION_PART_NO = ($_POST['RELATION_PART_NO']=='') ? NULL : $_POST['RELATION_PART_NO'];
$RELATION_SLNOINPART = ($_POST['RELATION_SLNOINPART']=='') ? NULL : $_POST['RELATION_SLNOINPART'];
$caste = ($_POST['caste']=='')  ? NULL : $_POST['caste'];
$isMarried = ($_POST['isMarried']=='') ? NULL : $_POST['isMarried'];
$voter_label = ($_POST['voter_label'] == '') ? NULL : $_POST['voter_label'];
$political_party = ($_POST['political_party'] == '') ? NULL : $_POST['political_party'];
$isDead = ($_POST['isDead'] == '') ? NULL : $_POST['isDead'];
$profile_image = $_POST['profile_image'];
$user_type = 1;
$query = "select * from voters_data where id='$voter_id'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$response = new stdClass();
if(mysqli_num_rows($result)==1){

    if($_FILES['profile_image']['name'] != '')
    {
        $allowed_extension = array('avif','png','PNG','JPG','jpg','JPEG','.JPEG');
        $file_array = explode(".", $_FILES["profile_image"]["name"]);
        $extension = end($file_array);
        if(in_array($extension, $allowed_extension)){

            $filename   = uniqid() . "-voter-image-" . time();
            $basename   = $filename . "." . $extension; 
            $file_name = $_FILES['profile_image']['name'];
            $file_size =$_FILES['profile_image']['size'];
            $file_tmp =$_FILES['profile_image']['tmp_name'];
            $file_type=$_FILES['profile_image']['type']; 
            $file = "../uploads/{$basename}";  
            move_uploaded_file($_FILES['profile_image']['tmp_name'],$file);

            $query = "UPDATE `voters_data` SET `AC_NO`='$AC_NO',`PART_NO`='$PART_NO',`SECTION_NO`='$SECTION_NO',`SLNOINPART`='$SLNOINPART',`C_HOUSE_NO`='$C_HOUSE_NO',
            `C_HOUSE_NO_V1`='$C_HOUSE_NO_V1',`FM_NAME_EN`='$FM_NAME_EN',`LASTNAME_EN`='$LASTNAME_EN',`FM_NAME_V1`='$FM_NAME_V1',`LASTNAME_V1`='$LASTNAME_V1',`RLN_TYPE`='$RLN_TYPE',
            `RLN_FM_NM_EN`='$RLN_FM_NM_EN',`RLN_L_NM_EN`='$RLN_L_NM_EN',`RLN_FM_NM_V1`='$RLN_FM_NM_V1',`RLN_L_NM_V1`='$RLN_L_NM_V1',`EPIC_NO`='$EPIC_NO',`GENDER`='$GENDER',
            `AGE`='$AGE',`DOB`='$DOB',`MOBILE_NO`='$MOBILE_NO',`AC_NAME_EN`='$AC_NAME_EN',`AC_NAME_V1`='$AC_NAME_V1',`SECTION_NAME_EN`='$SECTION_NAME_EN',
            `SECTION_NAME_V1`='$SECTION_NAME_V1',`PSBUILDING_NAME_EN`='$PSBUILDING_NAME_EN',`PSBUILDING_NAME_V1`='$PSBUILDING_NAME_V1',`PART_NAME_EN`='$PART_NAME_EN',`PART_NAME_V1`='$PART_NAME_V1',
            `profile_image`='$basename',
            `aadhar`='$aadhar',
            `caste`='$caste',
            `RELATION_PART_NO`='$RELATION_PART_NO',
            `RELATION_SLNOINPART`='$RELATION_SLNOINPART',
            `isMarried`='$isMarried',
            `voter_label`='$voter_label',
            `political_party`='$political_party',
            `isDead`='$isDead'
            WHERE `id`='$voter_id'";
            $result = mysqli_query($conn,$query);



            $response->error = "";
            $response->message = "Voter updated successfully.";
        }else{
            $response->error = 'Not a valid image file.';
        }
    }else{
        $query = "UPDATE `voters_data` SET `AC_NO`='$AC_NO',`PART_NO`='$PART_NO',`SECTION_NO`='$SECTION_NO',`SLNOINPART`='$SLNOINPART',`C_HOUSE_NO`='$C_HOUSE_NO',
            `C_HOUSE_NO_V1`='$C_HOUSE_NO_V1',`FM_NAME_EN`='$FM_NAME_EN',`LASTNAME_EN`='$LASTNAME_EN',`FM_NAME_V1`='$FM_NAME_V1',`LASTNAME_V1`='$LASTNAME_V1',`RLN_TYPE`='$RLN_TYPE',
            `RLN_FM_NM_EN`='$RLN_FM_NM_EN',`RLN_L_NM_EN`='$RLN_L_NM_EN',`RLN_FM_NM_V1`='$RLN_FM_NM_V1',`RLN_L_NM_V1`='$RLN_L_NM_V1',`EPIC_NO`='$EPIC_NO',`GENDER`='$GENDER',
            `AGE`='$AGE',`DOB`='$DOB',`MOBILE_NO`='$MOBILE_NO',`AC_NAME_EN`='$AC_NAME_EN',`AC_NAME_V1`='$AC_NAME_V1',`SECTION_NAME_EN`='$SECTION_NAME_EN',
            `SECTION_NAME_V1`='$SECTION_NAME_V1',`PSBUILDING_NAME_EN`='$PSBUILDING_NAME_EN',`PSBUILDING_NAME_V1`='$PSBUILDING_NAME_V1',`PART_NAME_EN`='$PART_NAME_EN',`PART_NAME_V1`='$PART_NAME_V1',
            `aadhar`='$aadhar',
            `caste`='$caste',
            `RELATION_PART_NO`='$RELATION_PART_NO',
            `RELATION_SLNOINPART`='$RELATION_SLNOINPART',
            `isMarried`='$isMarried',
            `voter_label`='$voter_label',
            `political_party`='$political_party',
            `isDead`='$isDead'
            WHERE `id`='$voter_id'";
        $result = mysqli_query($conn,$query);

        $response->error = "";
        $response->message = "Voter updated successfully.";
    }


    
}else{
    $response->error = "Voter not found!";
}
echo json_encode($response);
?>