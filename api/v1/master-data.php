<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
include ('../../config/conn.php');

$leader_id=0;
if($_POST['leader_id']){
    $leader_id=$_POST['leader_id'];
}

$query = "select * from states";
$result = mysqli_query($conn,$query);

$query2 = "select * from cities";
$result2 = mysqli_query($conn,$query2);

$query3 = "select * from labharthi_scheme";
$result3 = mysqli_query($conn,$query3);

$query4 = "select * from political_party";
$result4 = mysqli_query($conn,$query4);

$query5 = "SELECT DISTINCT AC_NAME_EN FROM `voters_data` WHERE AC_NAME_EN IS NOT NULL AND AC_NAME_EN!='' AND leader_id=$leader_id";
$result5 = mysqli_query($conn,$query5);

$query6 = "select * from voters_label where leader_id=$leader_id";
$result6 = mysqli_query($conn,$query6);

$query7 = "select * from compaign where leader_id=$leader_id";
$result7 = mysqli_query($conn,$query7);

$query8 = "select * from social_media where leader_id=$leader_id";
$result8 = mysqli_query($conn,$query8);

$query9 = "SELECT DISTINCT CAST(SECTION_NO AS UNSIGNED) AS SECTION_NO from voters_data WHERE leader_id=$leader_id ORDER BY SECTION_NO ASC";
$result9 = mysqli_query($conn,$query9);


$response = new stdClass();
$state = [];
$city = [];
$labharthi_scheme = [];
$political_party = [];
$area = [];
$label_value = [];
$compaign = [];
$social_media = [];
$SECTION_NO = [];

$i=0;
while($row = mysqli_fetch_assoc($result)){
    $state[$i] = $row;
    $i++;
}

$j=0;
while($row2 = mysqli_fetch_assoc($result2)){
    $city[$j] = $row2;
    $j++;
}

$k=0;
while($row3 = mysqli_fetch_assoc($result3)){
    $labharthi_scheme[$k] = $row3;
    $k++;
}

$l=0;
while($row4 = mysqli_fetch_assoc($result4)){
    $political_party[$l] = $row4;
    $l++;
}

$m=0;
while($row5 = mysqli_fetch_assoc($result5)){
    $area[$m] = $row5;
    $m++;
}

$n=0;
while($row6 = mysqli_fetch_assoc($result6)){
    $label_value[$n] = $row6;
    $n++;
}

$o=0;
while($row7 = mysqli_fetch_assoc($result7)){
    $compaign[$o] = $row7;
    $o++;
}
 
$p=0;
while($row8 = mysqli_fetch_assoc($result8)){
    $social_media[$p] = $row8;
    $p++;
}

$q=0;
while($row9 = mysqli_fetch_assoc($result9)){
    $SECTION_NO[$q] = $row9;
    $q++;
}


$response->message = "success";
$response->data['state'] = $state;
$response->data['city'] = $city;
$response->data['labharthi_scheme'] = $labharthi_scheme;
$response->data['political_party'] = $political_party;
$response->data['area'] = $area;
$response->data['label_value'] = $label_value;
$response->data['compaign'] = $compaign;
$response->data['social_media'] = $social_media;
$response->data['SECTION_NO'] = $SECTION_NO;
echo json_encode($response);
?>