<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../config/conn.php');

//fetch voter_label
$voter_label = [];
$political_party=[];
$area_list=[];
if(isset($_POST) && $_POST['voter_label']!=''){
    $q1 = "SELECT * from voters_label WHERE leader_id=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $voter_label[] = $row1;
    }
}

if(isset($_POST) && $_POST['action']=='voter_political'){
    $q1 = "SELECT * from voters_label WHERE leader_id=".$_POST['leader_id'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $voter_label[] = $row1;
    }
    $q1 = "SELECT * from political_party";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $political_party[] = $row1;
    }

    $q1 = "SELECT DISTINCT AC_NAME_EN from voters_data";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $area_list[] = $row1;
    }
}

if(isset($_POST) && $_POST['action']=='leader_voter_label'){
    $q1 = "SELECT * from voters_label WHERE id=".$_POST['id'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $voter_label[] = $row1;
    }
}
//fetch AC_NO
$q1 = "SELECT DISTINCT AC_NO from voters_data";
$r1 = mysqli_query($conn,$q1);
$AC_NO = [];
$output = new stdClass();
while($row1 = mysqli_fetch_assoc($r1)){
    $AC_NO[] = $row1;
}

//fetch PART_NO
$PART_NO = [];
if(isset($_POST) && $_POST['AC_NO']!=''){
    $q1 = "SELECT DISTINCT PART_NO from voters_data WHERE AC_NO='".$_POST['AC_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $PART_NO[] = $row1;
    }
}

//fetch SECTION_NO
$SECTION_NO = [];
if(isset($_POST) && $_POST['AC_NO']!='' && $_POST['PART_NO']!=''){
    $q1 = "SELECT DISTINCT SECTION_NO from voters_data WHERE AC_NO='".$_POST['AC_NO']."' AND PART_NO='".$_POST['PART_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $SECTION_NO[] = $row1;
    }
}

if(isset($_POST) && $_POST['action']=='SEC_DISTINCT'){
    //$q1 = "SELECT DISTINCT SECTION_NO from voters_data WHERE leader_id='".$_POST['user_id']."'";
    $q1 = "SELECT DISTINCT SECTION_NO,CONVERT(SUBSTRING_INDEX(SECTION_NO,'-',-1),UNSIGNED INTEGER) AS num from voters_data WHERE leader_id='".$_POST['user_id']."' ORDER BY num ASC";
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $SECTION_NO[] = $row1;
    }
    
}


//fetch state
$q1 = "SELECT * from states";
$r1 = mysqli_query($conn,$q1);
$state = [];
$output = new stdClass();
while($row1 = mysqli_fetch_assoc($r1)){
    $state[] = $row1;
}

//fetch city
$city = [];
if(isset($_POST) && $_POST['state']!=''){
    $q1 = "SELECT * from cities WHERE state_id=".$_POST['state'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $city[] = $row1;
    }
}

if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='change_status'){
   $q1 = "SELECT * FROM user_tbl WHERE id=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);
    $row1 = mysqli_fetch_assoc($r1);
    $status= 0;
    if($row1['isActive']==0){
        $status=1;
    }
    $q1 = "UPDATE `user_tbl` SET `isActive`= $status  WHERE `id`=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    $output->statusChanged = true;
    
}

$userData = new stdClass();
if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='user_data'){
    $q1 = "SELECT * FROM user_tbl WHERE id=".$_POST['user_id'];
     $r1 = mysqli_query($conn,$q1);
     while($row1 = mysqli_fetch_assoc($r1)){
     $userData = $row1;
     }

     //PART_NO query
    $q1 = "SELECT DISTINCT PART_NO from voters_data WHERE AC_NO='".$userData['AC_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $PART_NO[] = $row1;
    }

    //SECTION_NO query
    $q1 = "SELECT DISTINCT SECTION_NO from voters_data WHERE AC_NO='".$userData['AC_NO']."' AND PART_NO='".$userData['PART_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $SECTION_NO[] = $row1;
    }

    //selected booth
    $q1 = "SELECT * FROM `user_assigned_booth` WHERE user_id=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);
    $boothRow = [];
    while($row1 = mysqli_fetch_assoc($r1)){
        $boothRow[] = $row1;
    }
    $userData['selectedBooth'] = $boothRow;

    //city query
    $q1 = "SELECT * from cities WHERE state_id=".$userData['state'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $city[] = $row1;
    }

     $output = new stdClass();
     $output->userData = $userData;
     
 }

 if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='edit_user_data'){
     $q1 = "SELECT user_tbl.*,u2.AC_NO as AC_NOS,u2.PART_NO as PART_NOS FROM user_tbl LEFT JOIN user_tbl as u2 ON u2.id=user_tbl.leader_id WHERE user_tbl.id=".$_POST['user_id']."";
     $r1 = mysqli_query($conn,$q1);
     while($row1 = mysqli_fetch_assoc($r1)){
     $userData = $row1;
     }

     //PART_NO query
    $q1 = "SELECT DISTINCT PART_NO from voters_data WHERE AC_NO='".$userData['AC_NOS']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $PART_NO[] = $row1;
    }

    //SECTION_NO query
    $q1 = "SELECT DISTINCT SECTION_NO from voters_data WHERE leader_id='".$userData['leader_id']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $SECTION_NO[] = $row1;
    }

    //selected booth
    $q1 = "SELECT * FROM `user_assigned_booth` WHERE user_id=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);
    $boothRow = [];
    while($row1 = mysqli_fetch_assoc($r1)){
        $boothRow[] = $row1;
    }
    $userData['selectedBooth'] = $boothRow;

    //city query
    $q1 = "SELECT * from cities WHERE state_id=".$userData['state'];
    $r1 = mysqli_query($conn,$q1);
    $output = new stdClass();
    while($row1 = mysqli_fetch_assoc($r1)){
        $city[] = $row1;
    }

     $output = new stdClass();
     $output->userData = $userData;
     
 }


 if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='delete_user'){
     //delete leader from user_tbl
    $q1 = "DELETE FROM user_tbl WHERE id=".$_POST['user_id'];
    $r1 = mysqli_query($conn,$q1);

     //delete sub from user_tbl
     $q1 = "DELETE FROM user_tbl WHERE leader_id=".$_POST['user_id'];
     $r1 = mysqli_query($conn,$q1);

     //delete from booth
     $q1 = "DELETE FROM user_assigned_booth WHERE user_id=".$_POST['user_id'];
     $r1 = mysqli_query($conn,$q1);

     $output->userDeleted = true;
     
 }

 $leader_list = [];
if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='leader_list'){
    $q1 = "SELECT * FROM user_tbl WHERE user_type=1";
     $r1 = mysqli_query($conn,$q1);
     while($row1 = mysqli_fetch_assoc($r1)){
     $leader_list[] = $row1;
     }
}  

$dashboardData = new stdClass();
if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='dashboard_data'){
    //total booth workers :
    $q1 = "SELECT * FROM user_tbl WHERE user_type!=0";
     $r1 = mysqli_query($conn,$q1);
     $dashboardData->totalBoothWorkers=mysqli_num_rows($r1);
    //total polling booth :
    $q1 = "SELECT DISTINCT SECTION_NO FROM `voters_data`";
    $r1 = mysqli_query($conn,$q1);
    $dashboardData->totalPollingBooth=mysqli_num_rows($r1);
     //total male voters :
     $q1 = "SELECT * FROM `voters_data` WHERE GENDER='M'";
     $r1 = mysqli_query($conn,$q1);
     $dashboardData->totalMaleVoters=mysqli_num_rows($r1);
     //total female voters :
     $q1 = "SELECT * FROM `voters_data` WHERE GENDER='F'";
     $r1 = mysqli_query($conn,$q1);
     $dashboardData->totalFemaleVoters=mysqli_num_rows($r1);
}  

$voterData = new stdClass();
$SLNOINPART = [];
if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='voter_data'){
    $q1 = "SELECT * FROM voters_data WHERE id=".$_POST['voter_id'];
     $r1 = mysqli_query($conn,$q1);
     while($row1 = mysqli_fetch_assoc($r1)){
     $voterData = $row1;
     }

     $q1 = "SELECT DISTINCT PART_NO from voters_data WHERE AC_NO='".$voterData['AC_NO']."'";
     $r1 = mysqli_query($conn,$q1);
     while($row1 = mysqli_fetch_assoc($r1)){
         $PART_NO[] = $row1;
     }

    $q1 = "SELECT DISTINCT SECTION_NO from voters_data WHERE AC_NO='".$voterData['AC_NO']."' AND PART_NO='".$voterData['PART_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $SECTION_NO[] = $row1;
    }
    $q1 = "SELECT DISTINCT SLNOINPART from voters_data WHERE AC_NO='".$voterData['AC_NO']."' AND PART_NO='".$voterData['PART_NO']."' AND SECTION_NO='".$voterData['SECTION_NO']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $SLNOINPART[] = $row1;
    }

    $q1 = "SELECT * from voters_label WHERE leader_id='".$_POST['leader_id']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $voter_label[] = $row1;
    }

    $q1 = "SELECT * from political_party";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $political_party[] = $row1;
    }

     $output = new stdClass();
     $output->voterData = $voterData;
     
 }

 //fetch SLNOINPART
if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='SLNOINPART'){
    $q1 = "SELECT DISTINCT SLNOINPART from voters_data WHERE AC_NO='".$_POST['acNo']."' AND PART_NO='".$_POST['partNo']."' AND SECTION_NO='".$_POST['sectionNo']."'";
    $r1 = mysqli_query($conn,$q1);
    while($row1 = mysqli_fetch_assoc($r1)){
        $SLNOINPART[] = $row1;
    }
}

if(isset($_POST) && $_POST['action']!='' && $_POST['action']=='delete_label'){
    //delete leader from user_tbl
   $q1 = "DELETE FROM voters_label WHERE id=".$_POST['id'];
   $r1 = mysqli_query($conn,$q1);

    $output->labelDeleted = true;
    
}



$output->AC_NO = $AC_NO;
$output->PART_NO = $PART_NO;
$output->SECTION_NO = $SECTION_NO;
$output->SLNOINPART = $SLNOINPART;
$output->state = $state;
$output->city= $city;
$output->leader_list= $leader_list;
$output->dashboardData= $dashboardData;
$output->voter_label= $voter_label;
$output->voterData= $voterData;
$output->political_party= $political_party;
$output->area_list= $area_list;
echo json_encode($output);
?>