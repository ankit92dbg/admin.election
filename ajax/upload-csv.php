<?php
 session_start();
header("Content-Encoding: none");
include ('../config/conn.php');
if(isset($_FILES['file']['name']))
{
 $error = '';
 $total_line = 0;
 $leader_id = $_POST['leader_id'];
 $job_id = $_POST['job_id'];
 if($_FILES['file']['name'] != '')
 {
  $allowed_extension = array('csv');
  $file_array = explode(".", $_FILES["file"]["name"]);
  $extension = end($file_array);
  if(in_array($extension, $allowed_extension))
  {
//    $new_file_name = rand() . '.' . $extension;
//    move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/'.$new_file_name);
   


   $filename   = uniqid() . "-csv-file-" . time();
   $basename   = $filename . "." . $extension; 
   $file_name = $_FILES['file']['name'];
   $file_size =$_FILES['file']['size'];
   $file_tmp =$_FILES['file']['tmp_name'];
   $file_type=$_FILES['file']['type']; 
   $file = "../uploads/{$basename}";  
   move_uploaded_file($_FILES['file']['tmp_name'],$file);
   $file_content = file('../uploads/'. $file, FILE_SKIP_EMPTY_LINES);
   $total_line = count($file_content);
   $filesize = filesize($file);
   header('Content-Length: '.$filesize);
   header("Content-Range: 0-".($filesize-1)."/".$filesize);
   //make db entry :
   $file_data = fopen('../uploads/'.$file, 'r');

   fgetcsv($file_data);
  $i=0;
   while($row = fgetcsv($file_data))
   {
    // print_r(mysqli_real_escape_string($conn,$row[0]));
    $AC_NO = mysqli_real_escape_string($conn,$row[0]);
    $PART_NO = mysqli_real_escape_string($conn,$row[1]);
    $SECTION_NO = mysqli_real_escape_string($conn,$row[2]);
    $SLNOINPART = mysqli_real_escape_string($conn,$row[3]);
    $C_HOUSE_NO = mysqli_real_escape_string($conn,$row[4]);
    $C_HOUSE_NO_V1 = mysqli_real_escape_string($conn,$row[5]);
    $FM_NAME_EN = mysqli_real_escape_string($conn,$row[6]);
    $LASTNAME_EN = mysqli_real_escape_string($conn,$row[7]);
    $FM_NAME_V1 = mysqli_real_escape_string($conn,$row[8]);
    $LASTNAME_V1 = mysqli_real_escape_string($conn,$row[9]);
    $RLN_TYPE = mysqli_real_escape_string($conn,$row[10]);
    $RLN_FM_NM_EN = mysqli_real_escape_string($conn,$row[11]);
    $RLN_L_NM_EN = mysqli_real_escape_string($conn,$row[12]);
    $RLN_FM_NM_V1 = mysqli_real_escape_string($conn,$row[13]);
    $RLN_L_NM_V1 = mysqli_real_escape_string($conn,$row[14]);
    $EPIC_NO = mysqli_real_escape_string($conn,$row[15]);
    $GENDER = mysqli_real_escape_string($conn,$row[16]);
    $AGE = mysqli_real_escape_string($conn,$row[17]);
    $DOB = mysqli_real_escape_string($conn,$row[18]);
    $MOBILE_NO = mysqli_real_escape_string($conn,$row[19]);
    $AC_NAME_EN = mysqli_real_escape_string($conn,$row[20]);
    $AC_NAME_V1 = mysqli_real_escape_string($conn,$row[21]);
    $SECTION_NAME_EN = mysqli_real_escape_string($conn,$row[22]);
    $SECTION_NAME_V1 = mysqli_real_escape_string($conn,$row[23]);
    $PSBUILDING_NAME_EN = mysqli_real_escape_string($conn,$row[24]);
    $PSBUILDING_NAME_V1 = mysqli_real_escape_string($conn,$row[25]);
    $PART_NAME_EN = mysqli_real_escape_string($conn,$row[26]);
    $PART_NAME_V1 = mysqli_real_escape_string($conn,$row[27]);

    $checkSql = "SELECT * FROM voters_data WHERE AC_NO='$AC_NO' AND PART_NO='$PART_NO' AND SECTION_NO='$SECTION_NO' AND SLNOINPART='$SLNOINPART'";
    $checkRes = mysqli_query($conn,$checkSql);
    if(mysqli_num_rows($checkRes)>0){
        $query = "UPDATE `voters_data` SET 
        `C_HOUSE_NO`='$C_HOUSE_NO',
        C_HOUSE_NO_V1='$C_HOUSE_NO_V1',
        FM_NAME_EN='$FM_NAME_EN',
        LASTNAME_EN='$LASTNAME_EN',
        FM_NAME_V1='$FM_NAME_V1',
        LASTNAME_V1='$LASTNAME_V1',
        RLN_TYPE='$RLN_TYPE',
        RLN_FM_NM_EN='$RLN_FM_NM_EN',
        RLN_L_NM_EN='$RLN_L_NM_EN',
        RLN_FM_NM_V1='$RLN_FM_NM_V1',
        RLN_L_NM_V1='$RLN_L_NM_V1',
        EPIC_NO='$EPIC_NO',
        GENDER='$GENDER',
        AGE='$AGE',
        DOB='$DOB',
        MOBILE_NO='$MOBILE_NO',
        AC_NAME_EN='$AC_NAME_EN',
        AC_NAME_V1='$AC_NAME_V1',
        SECTION_NAME_EN='$SECTION_NAME_EN',
        SECTION_NAME_V1='$SECTION_NAME_V1',
        PSBUILDING_NAME_EN='$PSBUILDING_NAME_EN',
        PSBUILDING_NAME_V1='$PSBUILDING_NAME_V1',
        PART_NAME_EN='$PART_NAME_EN',
        PART_NAME_V1='$PART_NAME_V1'
        WHERE
        AC_NO = '$AC_NO' AND 
        PART_NO = '$PART_NO' AND
        SECTION_NO = '$SECTION_NO' AND
        leader_id = '$leader_id' AND
        SLNOINPART = '$SLNOINPART'
        ";
    }else{
        $query = "
        INSERT INTO voters_data (
        leader_id,    
        AC_NO, 
        PART_NO,
        SECTION_NO,
        SLNOINPART,
        C_HOUSE_NO,
        C_HOUSE_NO_V1,
        FM_NAME_EN,
        LASTNAME_EN,
        FM_NAME_V1,
        LASTNAME_V1,
        RLN_TYPE,
        RLN_FM_NM_EN,
        RLN_L_NM_EN,
        RLN_FM_NM_V1,
        RLN_L_NM_V1,
        EPIC_NO,
        GENDER,
        AGE,
        DOB,
        MOBILE_NO,
        AC_NAME_EN,
        AC_NAME_V1,
        SECTION_NAME_EN,
        SECTION_NAME_V1,
        PSBUILDING_NAME_EN,
        PSBUILDING_NAME_V1,
        PART_NAME_EN,
        PART_NAME_V1
        ) 
        VALUES (
            '$leader_id', 
            '$AC_NO', 
            '$PART_NO',
            '$SECTION_NO',
            '$SLNOINPART',
            '$C_HOUSE_NO',
            '$C_HOUSE_NO_V1',
            '$FM_NAME_EN',
            '$LASTNAME_EN',
            '$FM_NAME_V1',
            '$LASTNAME_V1',
            '$RLN_TYPE',
            '$RLN_FM_NM_EN',
            '$RLN_L_NM_EN',
            '$RLN_FM_NM_V1',
            '$RLN_L_NM_V1',
            '$EPIC_NO',
            '$GENDER',
            '$AGE',
            '$DOB',
            '$MOBILE_NO',
            '$AC_NAME_EN',
            '$AC_NAME_V1',
            '$SECTION_NAME_EN',
            '$SECTION_NAME_V1',
            '$PSBUILDING_NAME_EN',
            '$PSBUILDING_NAME_V1',
            '$PART_NAME_EN',
            '$PART_NAME_V1'
            )
        ";
    }
        mysqli_query($conn,$query);
        $output = array(
            'success'  => true,
            'line' => $i,
            'total_line' => ($total_line - 1)
           );
        echo json_encode($output);
        //add uploaded index
        // $chekQuery = "select * from upload_progress where job_id='$job_id'";
        // $cRes = mysqli_query($conn,$chekQuery);
        // if(mysqli_num_rows($cRes) > 0){
        //     $chekQuery1 = "update upload_progress set `uploaded_line`='$i' where `job_id`='$job_id'";
        //     $cRes1 = mysqli_query($conn,$chekQuery1);
        // }else{
        //     $tl = $total_line-1;
        //     $chekQuery1 = "insert into upload_progress (job_id,uploaded_line,total_line) values('$job_id','$i','$tl')";
        //     $cRes1 = mysqli_query($conn,$chekQuery1);
        // }
        $i++;
    }


  }
  else
  {
   $error = 'Only CSV file format is allowed';
  }
 }
 else
 {
  $error = 'Please Select File';
 }

 if($error != '')
 {
  $output = array(
   'error'  => $error
  );
 } 
 else
 {
  $output = array(
   'success'  => true,
   'total_line' => ($total_line - 1)
  );
 }

 echo json_encode($output);
}
?>