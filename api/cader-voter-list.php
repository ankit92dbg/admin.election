<?php  
 session_start();
include ('../config/conn.php');

 $record_per_page = $_POST["total_records"];  
 $search_str = $_POST["search_str"];  
 $leader_id = $_POST["leader_id"];  
 $user_id = $_POST["user_id"];  
 $language = $_POST['language'];
 $page = '';  
 $slNo = '';  
 $output = '';  
 $first=1;

$query = "select * from user_assigned_booth where user_id='$user_id'";
$result = mysqli_query($conn,$query);
$assigned_booth = [];
while($row = mysqli_fetch_assoc($result)){
$assigned_booth[] = $row['SECTION_NO'];
}

foreach($assigned_booth as $key => $value) {
    $assigned_booth[$key]="'".$value."'";
}

$new_assigned_booth = implode(",",$assigned_booth);

 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"]; 
 }  
 else  
 {  
      $page = 1;  
 }  
 $slNo = (($page*$record_per_page)-$record_per_page)+1;
 $start_from = ($page - 1)*$record_per_page;  
$query = "";
$page_query = "";
 if(isset($_POST['action']) && $_POST['action']=='searchTab'){
    $PART_NO_FROM = $_POST['PART_NO_FROM'];
    $PART_NO_TO = $_POST['PART_NO_TO'];
    $SECTION_NO = $_POST['SECTION_NO'];
    $C_HOUSE_NO = $_POST['C_HOUSE_NO'];
    $LASTNAME_EN = $_POST['LASTNAME_EN'];
    $FM_NAME_EN = $_POST['FM_NAME_EN'];
    $RLN_FM_NM_EN = $_POST['RLN_FM_NM_EN'];
    $EPIC_NO = $_POST['EPIC_NO'];
    $MOBILE_NO = $_POST['MOBILE_NO'];
    $fullName = $_POST['fullName'];
    $SECTION_NAME_EN = $_POST['SECTION_NAME_EN'];
    $filter_searchTab = $_POST['filter_searchTab'];
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    if($PART_NO_FROM!='' && $PART_NO_TO!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM AND $PART_NO_TO";
    }
    if($PART_NO_FROM!='' && $PART_NO_TO==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM";
    }
    if($SECTION_NO!=''){
        $WHERE .= " AND SECTION_NO =$SECTION_NO";
    }
    if($C_HOUSE_NO!=''){
        $WHERE .= " AND C_HOUSE_NO =$C_HOUSE_NO";
    }
    if($language=='english'){
        if($LASTNAME_EN!=''){
            $WHERE .= " AND LASTNAME_V1 LIKE '%$LASTNAME_EN%'";
        }
        if($FM_NAME_EN!=''){
            $WHERE .= " AND FM_NAME_V1  LIKE '%$FM_NAME_EN%'";
        }
        if($RLN_FM_NM_EN!=''){
            $WHERE .= " AND RLN_FM_NM_V1 LIKE '%$RLN_FM_NM_EN%'";
        }
    }else{
        if($LASTNAME_EN!=''){
            $WHERE .= " AND LASTNAME_EN LIKE '%$LASTNAME_EN%'";
        }
        if($FM_NAME_EN!=''){
            $WHERE .= " AND FM_NAME_EN  LIKE '%$FM_NAME_EN%'";
        }
        if($RLN_FM_NM_EN!=''){
            $WHERE .= " AND RLN_FM_NM_EN LIKE '%$RLN_FM_NM_EN%'";
        }
    }
    if($EPIC_NO!=''){
        $WHERE .= " AND EPIC_NO LIKE '%$EPIC_NO%'";
    }
    if($MOBILE_NO!=''){
        $WHERE .= " AND MOBILE_NO LIKE '%$MOBILE_NO%'";
    }
    if($language=='english'){
        if($fullName!=''){
            $WHERE .= " AND concat(UPPER(FM_NAME_EN),UPPER(LASTNAME_EN)) LIKE UPPER('%$fullName%')";
        }
    }else{
        if($fullName!=''){
            $WHERE .= " AND concat(UPPER(FM_NAME_V1),UPPER(LASTNAME_V1)) LIKE UPPER('%$fullName%')";
        }
    }
    if($SECTION_NAME_EN!=''){
        $WHERE .= " AND SECTION_NAME_EN LIKE '%$SECTION_NAME_EN%'";
    }
    if($filter_searchTab!=''){
        $WHERE .= " AND ($filter_searchTab IS NOT NULL AND $filter_searchTab !='') IS NOT NULL";
    }

    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY id ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY id ASC";
    
 }else if(isset($_POST['action']) && $_POST['action']=='alphaTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_ALPHA = $_POST['PART_NO_FROM_ALPHA'];
    $PART_NO_TO_ALPHA = $_POST['PART_NO_TO_ALPHA'];
    if($PART_NO_FROM_ALPHA!='' && $PART_NO_TO_ALPHA!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_ALPHA AND $PART_NO_TO_ALPHA";
    }
    if($PART_NO_FROM_ALPHA!='' && $PART_NO_TO_ALPHA==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_ALPHA";
    }
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='agewiseTab'){
    $WHERE = "";
    $SORT = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_AGE_FROM = $_POST['PART_NO_AGE_FROM'];
    $PART_NO_AGE_TO = $_POST['PART_NO_AGE_TO'];
    $AGE_FROM = $_POST['AGE_FROM'];
    $AGE_TO = $_POST['AGE_TO'];
    $GENDER_AGE = $_POST['GENDER_AGE'];
    $SORT_AGE = $_POST['SORT_AGE'];
    if($PART_NO_AGE_FROM!='' && $PART_NO_AGE_TO!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_AGE_FROM AND $PART_NO_AGE_TO";
    }
    if($PART_NO_AGE_FROM!='' && $PART_NO_AGE_TO==''){
        $WHERE .= " AND PART_NO=$PART_NO_AGE_FROM";
    }
    if($AGE_FROM!='' && $AGE_TO!=''){
        $WHERE .= " AND AGE BETWEEN $AGE_FROM AND $AGE_TO";
    }
    if($AGE_FROM!='' && $AGE_TO==''){
        $WHERE .= " AND AGE=$AGE_FROM";
    }
    if($GENDER_AGE!=''){
        $WHERE .= " AND GENDER = '$GENDER_AGE'";
    }
    if($SORT_AGE!=''){
        if($SORT_AGE=='Alphabetical'){
            $SORT .= " FM_NAME_EN ASC";
        }else{
            $SORT .= " id ASC";
        }
    }else{
        $SORT .= " id ASC";
    }
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY $SORT LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY $SORT";
 }else if(isset($_POST['action']) && $_POST['action']=='familyTab'){
    $WHERE = "";
    $HAVING = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_FAMILY = $_POST['PART_NO_FROM_FAMILY'];
    $PART_NO_TO_FAMILY = $_POST['PART_NO_TO_FAMILY'];
    $FAMILY_SIZE_FROM = $_POST['FAMILY_SIZE_FROM'];
    $FAMILY_SIZE_TO = $_POST['FAMILY_SIZE_TO'];
    $SURNAME_FAMILY = $_POST['SURNAME_FAMILY'];
    if($PART_NO_FROM_FAMILY!='' && $PART_NO_TO_FAMILY!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_FAMILY AND $PART_NO_TO_FAMILY";
    }
    if($PART_NO_FROM_FAMILY!='' && $PART_NO_TO_FAMILY==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_FAMILY";
    }
    if($FAMILY_SIZE_FROM!='' && $FAMILY_SIZE_TO!=''){
        $HAVING .= " HAVING COUNT(voters_data.id) BETWEEN $FAMILY_SIZE_FROM AND $FAMILY_SIZE_TO";
    }
    if($FAMILY_SIZE_FROM!='' && $FAMILY_SIZE_TO==''){
        $HAVING .= " HAVING COUNT(voters_data.id)=$FAMILY_SIZE_FROM";
    }
    if($SURNAME_FAMILY!=''){
        $WHERE .= " AND LASTNAME_EN LIKE '%$SURNAME_FAMILY%'";
    }
    $query = "SELECT voters_data.*, COUNT(voters_data.id) as family_count FROM voters_data WHERE $WHERE GROUP BY voters_data.C_HOUSE_NO, voters_data.SECTION_NAME_EN $HAVING  ORDER BY voters_data.FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT voters_data.*, COUNT(voters_data.id) as family_count FROM voters_data WHERE $WHERE GROUP BY voters_data.C_HOUSE_NO, voters_data.SECTION_NAME_EN $HAVING ORDER BY voters_data.FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='familyHeadTab'){
    $WHERE = "";
    $HAVING = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_FAMILY_HEAD = $_POST['PART_NO_FROM_FAMILY_HEAD'];
    $PART_NO_TO_FAMILY_HEAD = $_POST['PART_NO_TO_FAMILY_HEAD'];
    $FAMILY_HEAD_SIZE_FROM = $_POST['FAMILY_HEAD_SIZE_FROM'];
    $FAMILY_HEAD_SIZE_TO = $_POST['FAMILY_HEAD_SIZE_TO'];
    $FAMILY_HEAD_AGE_FROM = $_POST['FAMILY_HEAD_AGE_FROM'];
    $FAMILY_HEAD_AGE_TO = $_POST['FAMILY_HEAD_AGE_TO'];
    $FAMILY_HEAD_GENDER = $_POST['FAMILY_HEAD_GENDER'];
    $FAMILY_HEAD_CASTE = $_POST['FAMILY_HEAD_CASTE'];
    if($PART_NO_FROM_FAMILY_HEAD!='' && $PART_NO_TO_FAMILY_HEAD!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_FAMILY_HEAD AND $PART_NO_TO_FAMILY_HEAD";
    }
    if($PART_NO_FROM_FAMILY_HEAD!='' && $PART_NO_TO_FAMILY_HEAD==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_FAMILY_HEAD";
    }

    if($PART_NO_FAMILY_HEAD!=''){
        $WHERE .= " AND PART_NO IN ($PART_NO_FAMILY_HEAD)";
    }
    if($FAMILY_HEAD_SIZE_FROM!='' && $FAMILY_HEAD_SIZE_TO!=''){
        // $WHERE .= " AND family_size BETWEEN $FAMILY_HEAD_SIZE_FROM AND $FAMILY_HEAD_SIZE_TO";
        $HAVING .= " HAVING COUNT(voters_data.id) BETWEEN $FAMILY_HEAD_SIZE_FROM AND $FAMILY_HEAD_SIZE_TO";
    }
    if($FAMILY_HEAD_SIZE_FROM!='' && $FAMILY_HEAD_SIZE_TO==''){
        // $WHERE .= " AND family_size=$FAMILY_HEAD_SIZE_FROM";
        $HAVING .= " HAVING COUNT(voters_data.id)=$FAMILY_HEAD_SIZE_FROM";
    }
    if($FAMILY_HEAD_AGE_FROM!='' && $FAMILY_HEAD_AGE_TO!=''){
        $WHERE .= " AND AGE BETWEEN $FAMILY_HEAD_AGE_FROM AND $FAMILY_HEAD_AGE_TO";
    }
    if($FAMILY_HEAD_AGE_FROM!='' && $FAMILY_HEAD_AGE_TO==''){
        $WHERE .= " AND AGE=$FAMILY_HEAD_AGE_FROM";
    }
    if($FAMILY_HEAD_GENDER!=''){
        $WHERE .= " AND GENDER = '$FAMILY_HEAD_GENDER'";
    }
    if($FAMILY_HEAD_CASTE!=''){
        $WHERE .= " AND caste = '$FAMILY_HEAD_CASTE'";
    }
    // $query = "SELECT voters_data.*, COUNT(voters_data.id) as family_count FROM voters_data WHERE $WHERE GROUP BY voters_data.C_HOUSE_NO, voters_data.SECTION_NAME_EN $HAVING ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    // echo $page_query = "SELECT voters_data.*, COUNT(voters_data.id) as family_count FROM voters_data WHERE $WHERE GROUP BY voters_data.C_HOUSE_NO, voters_data.SECTION_NAME_EN $HAVING ORDER BY FM_NAME_EN ASC";
    $query = "SELECT v1.*,v2.* FROM voters_data as v1 JOIN (select C_HOUSE_NO,SECTION_NAME_EN, max(AGE) as maxAge,COUNT(*) as family_count from voters_data  group by C_HOUSE_NO,SECTION_NAME_EN ORDER BY `voters_data`.`C_HOUSE_NO` ASC) v2 ON V1.C_HOUSE_NO = v2.C_HOUSE_NO AND v1.SECTION_NAME_EN=v2.SECTION_NAME_EN AND v1.AGE=v2.maxAge WHERE $WHERE ORDER BY v1.FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT v1.*,v2.* FROM voters_data as v1 JOIN (select C_HOUSE_NO,SECTION_NAME_EN, max(AGE) as maxAge,COUNT(*) as family_count from voters_data  group by C_HOUSE_NO,SECTION_NAME_EN ORDER BY `voters_data`.`C_HOUSE_NO` ASC) v2 ON V1.C_HOUSE_NO = v2.C_HOUSE_NO AND v1.SECTION_NAME_EN=v2.SECTION_NAME_EN AND v1.AGE=v2.maxAge WHERE $WHERE ORDER BY v1.FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='doubleNameTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_DOUBLE = $_POST['PART_NO_FROM_DOUBLE'];
    $PART_NO_TO_DOUBLE = $_POST['PART_NO_TO_DOUBLE'];


    if($PART_NO_FROM_DOUBLE!='' && $PART_NO_TO_DOUBLE!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_DOUBLE AND $PART_NO_TO_DOUBLE";
    }
    if($PART_NO_FROM_DOUBLE!='' && $PART_NO_TO_DOUBLE==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_DOUBLE";
    }

    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='marriedTab'){
    $WHERE = "";
    $SORT = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $WHERE .= " AND isMarried=1 AND GENDER='F'";
    $AGE_MARRIED = $_POST['AGE_MARRIED'];
    $PART_NO_MARRIED_FROM = $_POST['PART_NO_MARRIED_FROM'];
    $PART_NO_MARRIED_TO = $_POST['PART_NO_MARRIED_TO'];
    $SORT_MARRIED = $_POST['SORT_MARRIED'];
    if($PART_NO_MARRIED_FROM!='' && $PART_NO_MARRIED_TO!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_MARRIED_FROM AND $PART_NO_MARRIED_TO";
    }
    if($PART_NO_MARRIED_FROM!='' && $PART_NO_MARRIED_TO==''){
        $WHERE .= " AND PART_NO=$PART_NO_MARRIED_FROM";
    }
    if($AGE_MARRIED!=''){
        $WHERE .= " AND AGE>=$AGE_MARRIED";
    }
    if($SORT_MARRIED!=''){
        if($SORT_MARRIED=='Alphabetical'){
            $SORT .= " FM_NAME_EN ASC";
        }else{
            $SORT .= " id ASC";
        }
    }else{
        $SORT .= " id ASC";
    }
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY $SORT LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY $SORT";
 }else if(isset($_POST['action']) && $_POST['action']=='singleTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $AGE_SINGLE_FROM = $_POST['AGE_SINGLE_FROM'];
    $AGE_SINGLE_TO = $_POST['AGE_SINGLE_TO'];
    $PART_NO_SINGLE_FROM = $_POST['PART_NO_SINGLE_FROM'];
    $PART_NO_SINGLE_TO = $_POST['PART_NO_SINGLE_TO'];
    $SORT_GENDER_SINGLE = $_POST['SORT_GENDER_SINGLE'];
    if($PART_NO_SINGLE_FROM!='' && $PART_NO_SINGLE_TO!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_SINGLE_FROM AND $PART_NO_SINGLE_TO";
    }
    if($PART_NO_SINGLE_FROM!='' && $PART_NO_SINGLE_TO==''){
        $WHERE .= " AND PART_NO=$PART_NO_SINGLE_FROM";
    }
    if($AGE_SINGLE_FROM!='' && $AGE_SINGLE_TO!=''){
        $WHERE .= " AND AGE BETWEEN $AGE_SINGLE_FROM AND $AGE_SINGLE_TO";
    }
    if($AGE_SINGLE_FROM!='' && $AGE_SINGLE_TO==''){
        $WHERE .= " AND AGE=$AGE_SINGLE_FROM";
    }
    if($SORT_GENDER_SINGLE!=''){
        $WHERE .= " AND GENDER = '$SORT_GENDER_SINGLE'";
    }
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='addressTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_ADDRESS = $_POST['PART_NO_FROM_ADDRESS'];
    $PART_NO_TO_ADDRESS = $_POST['PART_NO_TO_ADDRESS'];
    $SEARCH_ADDRESS = $_POST['SEARCH_ADDRESS'];


    if($PART_NO_FROM_ADDRESS!='' && $PART_NO_TO_ADDRESS!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_ADDRESS AND $PART_NO_TO_ADDRESS";
    }
    if($PART_NO_FROM_ADDRESS!='' && $PART_NO_TO_ADDRESS==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_ADDRESS";
    }
    
    if($SEARCH_ADDRESS!=''){
        if($language=='english'){
            $WHERE .= " AND voters_data.PSBUILDING_NAME_EN LIKE '%$SEARCH_ADDRESS%'";           
        }else{
            $WHERE .= " AND voters_data.PSBUILDING_NAME_V1 LIKE '%$SEARCH_ADDRESS%'";           
        }

    }
    $query = "SELECT voters_data.PART_NO,voters_data.PSBUILDING_NAME_EN,voters_data.PSBUILDING_NAME_V1, COUNT(CASE WHEN GENDER = 'M' THEN id END) AS males, COUNT(CASE WHEN GENDER = 'F' THEN id END) AS females, COUNT(*) AS Total FROM `voters_data` WHERE $WHERE GROUP BY voters_data.PSBUILDING_NAME_EN LIMIT $start_from, $record_per_page";
    $page_query = "SELECT voters_data.PART_NO,voters_data.PSBUILDING_NAME_EN,voters_data.PSBUILDING_NAME_V1, COUNT(CASE WHEN GENDER = 'M' THEN id END) AS males, COUNT(CASE WHEN GENDER = 'F' THEN id END) AS females, COUNT(*) AS Total FROM `voters_data` WHERE $WHERE GROUP BY voters_data.PSBUILDING_NAME_EN;";
 }else if(isset($_POST['action']) && $_POST['action']=='surnameTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_SURNAME = $_POST['PART_NO_FROM_SURNAME'];
    $PART_NO_TO_SURNAME = $_POST['PART_NO_TO_SURNAME'];
    $SEARCH_ADDRESS = $_POST['SEARCH_ADDRESS'];


    if($PART_NO_FROM_SURNAME!='' && $PART_NO_TO_SURNAME!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_SURNAME AND $PART_NO_TO_SURNAME";
    }
    if($PART_NO_FROM_SURNAME!='' && $PART_NO_TO_SURNAME==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_SURNAME";
    }
    if($SEARCH_SURNAME!=''){
        if($language=='english'){
            $WHERE .= " AND voters_data.LASTNAME_EN LIKE '%$SEARCH_SURNAME%'";       
        }else{
            $WHERE .= " AND voters_data.LASTNAME_V1 LIKE '%$SEARCH_SURNAME%'";         
        }
        
    }
    $query = "SELECT voters_data.PART_NO,voters_data.LASTNAME_EN,voters_data.LASTNAME_V1, COUNT(*) AS Total FROM `voters_data` WHERE $WHERE GROUP BY voters_data.LASTNAME_EN LIMIT $start_from, $record_per_page";
    $page_query = "SELECT voters_data.PART_NO,voters_data.LASTNAME_EN,voters_data.LASTNAME_V1, COUNT(*) AS Total FROM `voters_data` WHERE $WHERE GROUP BY voters_data.LASTNAME_EN;";
 }else if(isset($_POST['action']) && $_POST['action']=='familyLabelsTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_LABEL = $_POST['PART_NO_FROM_LABEL'];
    $PART_NO_TO_LABEL = $_POST['PART_NO_TO_LABEL'];
    $FAMILY_SIZE_FROM_LABEL = $_POST['FAMILY_SIZE_FROM_LABEL'];
    $FAMILY_SIZE_TO_LABEL = $_POST['FAMILY_SIZE_TO_LABEL'];
    if($PART_NO_FROM_LABEL!='' && $PART_NO_TO_LABEL!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_LABEL AND $PART_NO_TO_LABEL";
    }
    if($PART_NO_FROM_LABEL!='' && $PART_NO_TO_LABEL==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_LABEL";
    }
    if($FAMILY_SIZE_FROM_LABEL!='' && $FAMILY_SIZE_TO_LABEL!=''){
        $WHERE .= " AND family_size BETWEEN $FAMILY_SIZE_FROM_LABEL AND $FAMILY_SIZE_TO_LABEL";
    }
    if($FAMILY_SIZE_FROM_LABEL!='' && $FAMILY_SIZE_TO_LABEL==''){
        $WHERE .= " AND family_size=$FAMILY_SIZE_FROM_LABEL";
    }
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='smsTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_SMS = $_POST['PART_NO_FROM_SMS'];
    $PART_NO_TO_SMS = $_POST['PART_NO_TO_SMS'];
    $NAME_SMS = $_POST['NAME_SMS'];
    $SURNAME_SMS = $_POST['SURNAME_SMS'];
    $RELATIVE_SMS = $_POST['RELATIVE_SMS'];

    if($PART_NO_FROM_SMS!='' && $PART_NO_TO_SMS!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_SMS AND $PART_NO_TO_SMS";
    }
    if($PART_NO_FROM_SMS!='' && $PART_NO_TO_SMS==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_SMS";
    }
    if($NAME_SMS!=''){
        $WHERE .= " AND voters_data.FM_NAME_EN LIKE '%$NAME_SMS%'";
    }
    if($SURNAME_SMS!=''){
        $WHERE .= " AND voters_data.LASTNAME_EN LIKE '%$SURNAME_SMS%'";
    }
    if($RELATIVE_SMS!=''){
        $WHERE .= " AND voters_data.RLN_FM_NM_EN LIKE '%$RELATIVE_SMS%'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='casteTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_CASTE = $_POST['PART_NO_FROM_CASTE'];
    $PART_NO_TO_CASTE = $_POST['PART_NO_TO_CASTE'];
    $RELIGION_CASTE = $_POST['RELIGION_CASTE'];
    if($PART_NO_FROM_CASTE!='' && $PART_NO_TO_CASTE!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_CASTE AND $PART_NO_TO_CASTE";
    }
    if($PART_NO_FROM_CASTE!='' && $PART_NO_TO_CASTE==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_CASTE";
    }
    if($RELIGION_CASTE!=''){
        $WHERE .= " AND voters_data.caste ='$RELIGION_CASTE'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='labelValueTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_LABEL_VALUE = $_POST['PART_NO_FROM_LABEL_VALUE'];
    $PART_NO_TO_LABEL_VALUE = $_POST['PART_NO_TO_LABEL_VALUE'];
    $LABEL_VALUE = $_POST['LABEL_VALUE'];
    if($PART_NO_FROM_LABEL_VALUE!='' && $PART_NO_TO_LABEL_VALUE!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_LABEL_VALUE AND $PART_NO_TO_LABEL_VALUE";
    }
    if($PART_NO_FROM_LABEL_VALUE!='' && $PART_NO_TO_LABEL_VALUE==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_LABEL_VALUE";
    }
    if($LABEL_VALUE!=''){
        $WHERE .= " AND voter_label ='$LABEL_VALUE'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='areaWiseTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_AREA = $_POST['PART_NO_FROM_AREA'];
    $PART_NO_TO_AREA = $_POST['PART_NO_TO_AREA'];
    $LABEL_VALUE = $_POST['LABEL_VALUE'];
    if($PART_NO_FROM_AREA!='' && $PART_NO_TO_AREA!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_AREA AND $PART_NO_TO_AREA";
    }
    if($PART_NO_FROM_AREA!='' && $PART_NO_TO_AREA==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_AREA";
    }
    if($AREA_LIST!=''){
        $WHERE .= " AND AC_NAME_EN ='$AREA_LIST'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='partyWiseTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_PARTY = $_POST['PART_NO_FROM_PARTY'];
    $PART_NO_TO_PARTY = $_POST['PART_NO_TO_PARTY'];
    $PARTY_LIST = $_POST['PARTY_LIST'];
    if($PART_NO_FROM_PARTY!='' && $PART_NO_TO_PARTY!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_PARTY AND $PART_NO_TO_PARTY";
    }
    if($PART_NO_FROM_PARTY!='' && $PART_NO_TO_PARTY==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_PARTY";
    }
    if($PARTY_LIST!=''){
        $WHERE .= " AND political_party ='$PARTY_LIST'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='deadListTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_DEAD = $_POST['PART_NO_FROM_DEAD'];
    $PART_NO_TO_DEAD = $_POST['PART_NO_TO_DEAD'];
    $DEAD_LIST = $_POST['DEAD_LIST'];
    if($PART_NO_FROM_DEAD!='' && $PART_NO_TO_DEAD!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_DEAD AND $PART_NO_TO_DEAD";
    }
    if($PART_NO_FROM_DEAD!='' && $PART_NO_TO_DEAD==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_DEAD";
    }
    if($DEAD_LIST!=''){
        $WHERE .= " AND isDead ='$DEAD_LIST'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else if(isset($_POST['action']) && $_POST['action']=='birthdayTab'){
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $PART_NO_FROM_BIRTHDAY = $_POST['PART_NO_FROM_BIRTHDAY'];
    $PART_NO_TO_BIRTHDAY = $_POST['PART_NO_TO_BIRTHDAY'];
    $DATE_FROM_BIRTHDAY = (strlen($_POST['DATE_FROM_BIRTHDAY'])==1) ? sprintf("%02d", $_POST['DATE_FROM_BIRTHDAY']) : $_POST['DATE_FROM_BIRTHDAY'];
    $DATE_TO_BIRTHDAY = (strlen($_POST['DATE_TO_BIRTHDAY'])==1) ? sprintf("%02d", $_POST['DATE_TO_BIRTHDAY']) : $_POST['DATE_TO_BIRTHDAY'];
    $MONTH_LIST = $_POST['MONTH_LIST'];
    $FROM_DATE = $_POST['MONTH_LIST'].'-'.$DATE_FROM_BIRTHDAY;
    $TO_DATE = $_POST['MONTH_LIST'].'-'.$DATE_TO_BIRTHDAY;
    if($PART_NO_FROM_BIRTHDAY!='' && $PART_NO_TO_BIRTHDAY!=''){
        $WHERE .= " AND PART_NO BETWEEN $PART_NO_FROM_BIRTHDAY AND $PART_NO_TO_BIRTHDAY";
    }
    if($PART_NO_FROM_BIRTHDAY!='' && $PART_NO_TO_BIRTHDAY==''){
        $WHERE .= " AND PART_NO=$PART_NO_FROM_BIRTHDAY";
    }
    if($DATE_FROM_BIRTHDAY!='' && $DATE_TO_BIRTHDAY!=''){
        $WHERE .= " AND DATE_FORMAT(DOB, '%m-%d') BETWEEN '$FROM_DATE' AND '$TO_DATE'";
    }
    if($DATE_FROM_BIRTHDAY!='' && $DATE_TO_BIRTHDAY==''){
        $WHERE .= " AND DATE_FORMAT(DOB, '%m-%d')='$FROM_DATE'";
    }
    
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC LIMIT $start_from, $record_per_page";
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY FM_NAME_EN ASC";
 }else{
    $WHERE = "";
    $WHERE .= "leader_id='$leader_id'";
    $WHERE .= " AND SECTION_NO IN ($new_assigned_booth)";
    $query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY id ASC LIMIT $start_from, $record_per_page";  
    $page_query = "SELECT * FROM voters_data WHERE $WHERE ORDER BY id ASC";  
 }


//  if($search_str==''){
//     $query = "SELECT * FROM voters_data WHERE leader_id='$leader_id' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
//  }else{
//     $query = "SELECT * FROM voters_data WHERE leader_id='$leader_id' AND FM_NAME_EN LIKE '%".$search_str."%' OR LASTNAME_EN LIKE '%".$search_str."%' OR EPIC_NO LIKE '%".$search_str."%' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
//  }
 $result = mysqli_query($conn, $query); 
 if(isset($_POST['action']) && $_POST['action']=='doubleNameTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
              <th>Sl No.</th>
              <th>Part No.</th>
              <th>Number</th>
              <th>Name</th>
              <th>Sex</th>
              <th>Age</th>
              <th>Relative Name</th>
              <th>Part No. (Relative)</th>
              <th>Number (Relative)</th>
              <th>Action</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else if(isset($_POST['action']) && $_POST['action']=='addressTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
              <th>Sl No.</th>
              <th>Part No.</th>
              <th>Address</th>
              <th>Male</th>
              <th>Female</th>
              <th>Total</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else if(isset($_POST['action']) && $_POST['action']=='surnameTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
              <th>Sl No.</th>
              <th>Part No.</th>
              <th>Surname</th>
              <th>Total</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else if(isset($_POST['action']) && $_POST['action']=='familyLabelsTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
              <th>Sl No.</th>
              <th>Part No.</th>
              <th>Name</th>
              <th>House No.</th>
              <th>Address</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else if(isset($_POST['action']) && $_POST['action']=='smsTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
              <th>Sl No.</th>
              <th>Part No.</th>
              <th>Sr No.</th>
              <th>House No.</th>
              <th>Name</th>
              <th>Relation Type</th>
              <th>Relative Name</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Epic No.</th>
              <th>Address</th>
              <th>Mobile</th>
          </tr>
      </thead> 
      <tbody>
"; 
}else if(isset($_POST['action']) && $_POST['action']=='familyHeadTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
            <th>Sl No.</th>
            <th>Name</th>
            <th>Father/Husband Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Mobile No.</th>
            <th>Voter ID</th>
            <th>Part No.</th>
            <th>Address</th>
            <th>Total Family Member</th>
            <th>Action</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else if(isset($_POST['action']) && $_POST['action']=='birthdayTab') {
    $output .= "  
    <table class='table align-items-center mb-0'>  
      <thead>
          <tr>
            <th>Sl No.</th>
            <th>Name</th>
            <th>Father/Husband Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Mobile No.</th>
            <th>Voter ID</th>
            <th>Part No.</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Action</th>
          </tr>
      </thead> 
      <tbody>
"; 
 }else{
 $output .= "  
      <table class='table align-items-center mb-0'>  
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Name</th>
                <th>Father/Husband Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Mobile No.</th>
                <th>Voter ID</th>
                <th>Part No.</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
 ";  
 }

 while($row = mysqli_fetch_array($result))  
 {  
    if(isset($_POST['action']) && $_POST['action']=='doubleNameTab') {
        if($language=='english'){
            $output .= '  
            <tr>
            <td class="align-middle">
                '.$slNo.'
            </td>
            <td class="align-middle">
                '.$row['PART_NO'].'
            </td>
            <td class="align-middle">
                '.$row['SLNOINPART'].'
            </td>
            <td class="align-middle">
            <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].'</a>
            </td>
            <td class="align-middle">
                '.$row['GENDER'].'
            </td>
            <td class="align-middle">
                    '.$row['AGE'].'
            </td>
            <td class="align-middle">
                '.$row['RLN_FM_NM_EN'].'
            </td>
            <td class="align-middle">
                '.$row['RELATION_PART_NO'].'
            </td>
            <td class="align-middle">
                '.$row['RELATION_SLNOINPART'].'
            </td>
            <td class="align-middle">
                <div class="dp">
                    <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                        <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        </svg>
                    </a>
                    <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                        <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                    </ul>
                </div>
            </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SLNOINPART'].'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                        '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_V1'].'
                </td>
                <td class="align-middle">
                    '.$row['RELATION_PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['RELATION_SLNOINPART'].'
                </td>
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
                ';  
        }
    }else if(isset($_POST['action']) && $_POST['action']=='addressTab') {
        if($language=='english'){
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PSBUILDING_NAME_EN'].'
                </td>
                <td class="align-middle">
                    '.$row['males'].'
                </td>
                <td class="align-middle">
                    '.$row['females'].'
                </td>
                <td class="align-middle">
                        '.$row['Total'].'
                </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PSBUILDING_NAME_V1'].'
                </td>
                <td class="align-middle">
                    '.$row['males'].'
                </td>
                <td class="align-middle">
                    '.$row['females'].'
                </td>
                <td class="align-middle">
                        '.$row['Total'].'
                </td>
            </tr>
                ';  
        }
    }else if(isset($_POST['action']) && $_POST['action']=='surnameTab') {
        if($language=='english'){
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['LASTNAME_EN'].'
                </td>
                <td class="align-middle">
                        '.$row['Total'].'
                </td>
            </tr>
                ';  
        }else{
                $output .= '  
                <tr>
                    <td class="align-middle">
                        '.$slNo.'
                    </td>
                    <td class="align-middle">
                        '.$row['PART_NO'].'
                    </td>
                    <td class="align-middle">
                        '.$row['LASTNAME_V1'].'
                    </td>
                    <td class="align-middle">
                            '.$row['Total'].'
                    </td>
                </tr>
                    ';  
        }
    }else if(isset($_POST['action']) && $_POST['action']=='familyLabelsTab') {
        if($language=='english'){
            $output .= '  
            <tr>
            <td class="align-middle">
                '.$slNo.'
            </td>
            <td class="align-middle">
                '.$row['PART_NO'].'
            </td>
            <td class="align-middle">
            <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].'</a>
            </td>
            <td class="align-middle">
                    '.$row['C_HOUSE_NO'].'
            </td>
            <td class="align-middle">
                    '.$row['SECTION_NAME_EN'].'
            </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].'</a>
                </td>
                <td class="align-middle">
                        '.$row['C_HOUSE_NO_V1'].'
                </td>
                <td class="align-middle">
                        '.$row['SECTION_NAME_V1'].'
                </td>
            </tr>
                '; 
        }
    }else if(isset($_POST['action']) && $_POST['action']=='smsTab') {
        if($language=='english'){
            $output .= '  
            <tr>
            <td class="align-middle">
            <input class="" type="checkbox" value="" id="flexCheckDefault"> '.$slNo.'
            </td>
            <td class="align-middle">
                '.$row['PART_NO'].'
            </td>
            <td class="align-middle">
                '.$row['SLNOINPART'].'
            </td>
            <td class="align-middle">
                    '.$row['C_HOUSE_NO'].'
            </td>
            <td class="align-middle">
            <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].' '.$row['LASTNAME_EN'].'</a>
            </td>
            <td class="align-middle">
                    '.$row['RLN_TYPE'].'
            </td>
            <td class="align-middle">
                    '.$row['RLN_L_NM_EN'].'
            </td>
            <td class="align-middle">
                    '.$row['GENDER'].'
            </td>
            <td class="align-middle">
                    '.$row['AGE'].'
            </td>
            <td class="align-middle">
                    '.$row['EPIC_NO'].'
            </td>
            <td class="align-middle">
                    '.$row['PSBUILDING_NAME_EN'].'
            </td>
            <td class="align-middle">
                    '.$row['MOBILE_NO'].'
            </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                <input class="" type="checkbox" value="" id="flexCheckDefault"> '.$slNo.'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SLNOINPART'].'
                </td>
                <td class="align-middle">
                        '.$row['C_HOUSE_NO_V1'].'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].' '.$row['LASTNAME_V1'].'</a>
                </td>
                <td class="align-middle">
                        '.$row['RLN_TYPE'].'
                </td>
                <td class="align-middle">
                        '.$row['RLN_FM_NM_V1'].'
                </td>
                <td class="align-middle">
                        '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                        '.$row['AGE'].'
                </td>
                <td class="align-middle">
                        '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                        '.$row['PSBUILDING_NAME_V1'].'
                </td>
                <td class="align-middle">
                        '.$row['MOBILE_NO'].'
                </td>
            </tr>
                ';
        }  
    }else if(isset($_POST['action']) && $_POST['action']=='familyHeadTab') {
        if($language=='english'){
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].' '.$row['LASTNAME_EN'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_EN'].' ('.$row['RLN_TYPE'].')
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                    '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['MOBILE_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SECTION_NAME_EN'].'
                </td> 
                <td class="align-middle">
                    '.$row['family_count'].'
                </td> 
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].' '.$row['LASTNAME_V1'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_V1'].' ('.$row['RLN_TYPE'].')
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                    '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['MOBILE_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SECTION_NAME_V1'].'
                </td> 
                <td class="align-middle">
                    '.$row['family_count'].'
                </td> 
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
                ';
        }
    }else if(isset($_POST['action']) && $_POST['action']=='birthdayTab') {
        if($language=='english'){
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].' '.$row['LASTNAME_EN'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_EN'].' ('.$row['RLN_TYPE'].')
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                    '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['MOBILE_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SECTION_NAME_EN'].'
                </td> 
                <td class="align-middle">
                    '.$row['DOB'].'
                </td> 
                <td class="align-middle">
                    '.$row['family_count'].'
                </td> 
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
                ';  
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].' '.$row['LASTNAME_V1'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_V1'].' ('.$row['RLN_TYPE'].')
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                    '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['MOBILE_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SECTION_NAME_V1'].'
                </td> 
                <td class="align-middle">
                    '.$row['DOB'].'
                </td> 
                <td class="align-middle">
                    '.$row['family_count'].'
                </td> 
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
                ';  
        }
    }else{
        if(
            $language=='english'
        ){
            $output .= '  
            <tr>
              <td class="align-middle">
                  '.$slNo.'
              </td>
              <td class="align-middle">
              <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_EN'].' '.$row['LASTNAME_EN'].'</a>
              </td>
              <td class="align-middle">
                  '.$row['RLN_FM_NM_EN'].' ('.$row['RLN_TYPE'].')
              </td>
              <td class="align-middle">
                  '.$row['GENDER'].'
              </td>
              <td class="align-middle">
                  '.$row['AGE'].'
              </td>
              <td class="align-middle">
                  '.$row['MOBILE_NO'].'
              </td>
              <td class="align-middle">
                  '.$row['EPIC_NO'].'
              </td>
              <td class="align-middle">
                  '.$row['PART_NO'].'
              </td>
              <td class="align-middle">
                  '.$row['SECTION_NAME_EN'].'
              </td> 
              <td class="align-middle">
                  <div class="dp">
                      <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                          <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                          </svg>
                      </a>
                      <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                          <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                      </ul>
                  </div>
              </td>
          </tr>
            '; 
        }else{
            $output .= '  
            <tr>
                <td class="align-middle">
                    '.$slNo.'
                </td>
                <td class="align-middle">
                <a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">'.$row['FM_NAME_V1'].' '.$row['LASTNAME_V1'].'</a>
                </td>
                <td class="align-middle">
                    '.$row['RLN_FM_NM_V1'].' ('.$row['RLN_TYPE'].')
                </td>
                <td class="align-middle">
                    '.$row['GENDER'].'
                </td>
                <td class="align-middle">
                    '.$row['AGE'].'
                </td>
                <td class="align-middle">
                    '.$row['MOBILE_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['EPIC_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['PART_NO'].'
                </td>
                <td class="align-middle">
                    '.$row['SECTION_NAME_V1'].'
                </td> 
                <td class="align-middle">
                    <div class="dp">
                        <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                            <li><a class="dropdown-item" href="edit-voters.php?id='.$row['id'].'&candidate_id='.$user_id.'">Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            '; 
        }
       
    } 
      $slNo++;
 }   
 $output .= '</tbody>';
 $output .= '</table><br /><div align="center">';  
// if($search_str==''){
//  $page_query = "SELECT * FROM voters_data WHERE leader_id='$leader_id' ORDER BY id DESC";  
// }else{
//  $page_query = "SELECT * FROM voters_data WHERE leader_id='$leader_id' AND FM_NAME_EN LIKE '%".$search_str."%' OR LASTNAME_EN LIKE '%".$search_str."%' OR EPIC_NO LIKE '%".$search_str."%' ORDER BY id DESC";  
// }
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
$output .= '
  		<ul class="pagination">
	';

	$total_links = ceil($total_records/$record_per_page);

	$previous_link = '';

	$next_link = '';

	$page_link = '';
    $page_array = []; 

	if($total_links > 4 && $total_links!=5)
	{
		if($page < 5)
		{
			for($count = 1; $count <= 5; $count++)
			{
				$page_array[] = $count;
			}
			$page_array[] = '...';
			$page_array[] = $total_links;
		}
		else
		{
			$end_limit = $total_links - 5;

			if($page > $end_limit)
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $end_limit; $count <= $total_links; $count++)
				{
					$page_array[] = $count;
				}
			}
			else
			{
				$page_array[] = 1;

				$page_array[] = '...';

				for($count = $page - 1; $count <= $page + 1; $count++)
				{
					$page_array[] = $count;
				}

				$page_array[] = '...';

				$page_array[] = $total_links;
			}
		}
	}
	else
	{
		for($count = 1; $count <= $total_links; $count++)
		{
			$page_array[] = $count;
		}
	}

	for($count = 0; $count < count($page_array); $count++)
	{
		if($page == $page_array[$count])
		{
			$page_link .= '
			<li class="page-item active">
	      		<a style="color:#fff" class="page-link pagination_link" href="javascript:void(0);" id='.$page_array[$count].'>'.$page_array[$count].' <span class="sr-only">(current)</span></a>
	    	</li>
			';

			$previous_id = $page_array[$count] - 1;

			if($previous_id > 0)
			{
				$previous_link = '<li class="page-item"><a class="page-link pagination_link" id='.$previous_id.' href="javascript:load_data(`'.$_POST["query"].'`, '.$previous_id.')"><</a></li>';
			}
			else
			{
				$previous_link = '
				<li class="page-item disabled">
			        <a class="page-link" href="javascript:void(0);"><</a>
			    </li>
				';
			}

			$next_id = $page_array[$count] + 1;

			if($next_id > $total_links)
			{
				$next_link = '
				<li class="page-item disabled">
	        		<a class="page-link" href="javascript:void(0);">></a>
	      		</li>
				';
			}
			else
			{
				$next_link = '
				<li class="page-item"><a class="page-link pagination_link" id='.$next_id.' href="javascript:load_data(`'.$_POST["query"].'`, '.$next_id.')">></a></li>
				';
			}

		}
		else
		{
			if($page_array[$count] == '...')
			{
				$page_link .= '
				<li class="page-item disabled">
	          		<a class="page-link" href="javascript:void(0);">...</a>
	      		</li>
				';
			}
			else
			{
				$page_link .= '
				<li class="page-item">
					<a class="page-link pagination_link" id='.$page_array[$count].' href="javascript:load_data(`'.$_POST["query"].'`, '.$page_array[$count].')">'.$page_array[$count].'</a>
				</li>
				';
			}
		}
	}

	$output .= $previous_link . $page_link . $next_link;


	$output .= '
		</ul>
	</div>
	';
 echo $output;  
 ?>