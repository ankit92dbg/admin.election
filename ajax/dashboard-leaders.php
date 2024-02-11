<?php  
 session_start();
include ('../config/conn.php');
$slNo=1;
$query = "SELECT * FROM user_tbl WHERE user_type=1 ORDER BY id DESC LIMIT 10";  
 $result = mysqli_query($conn, $query);  
 $output .= "  
      <table class='table align-items-center mb-0'>  
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>AC_NO</th>
                <th>PART_NO</th>
                <th>SECTION_NO</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Status</th>
                <th>Created On</th>
            </tr>
        </thead> 
        <tbody>
 ";  
 while($row = mysqli_fetch_array($result))  
 {  
    $boothQuery = "select * from user_assigned_booth where user_id=".$row['id'];
    $boothRes = mysqli_query($conn,$boothQuery);
    $boothId = [];
    while($boothRow = mysqli_fetch_array($boothRes))  
    { 
        array_push($boothId,$boothRow['SECTION_NO']);
    }
	$profile_image = $row['profile_image'];

      $output .= '  
      <tr>
        <td class="align-middle text-center">
            '.$slNo.'
        </td>
        <td class="align-middle text-center">
            '.$row['AC_NO'].'
        </td>
        <td class="align-middle text-center">
            '.$row['PART_NO'].'
        </td>
        <td class="align-middle text-center">
            '.implode(',',$boothId).'
        </td>
        <td class="align-middle text-center">
		<img style="width: 50px;
		height: 50px;
		border-radius: 50%;" src="'.($profile_image==NULL ? '../assets/img/dummy-user.jpg' : "../uploads/$profile_image").'" />
            <p style="text-transform: capitalize;font-weight: 600;">'.$row['f_name'].' '.$row['l_name'].'</p>
        </td>
        <td class="align-middle text-center">
            '.$row['email'].'
        </td>
        <td class="align-middle text-center">
            '.$row['designation'].'
        </td>
        <td class="align-middle text-center">
            '.$row['phone'].'
        </td>
        <td class="align-middle text-center">
            '.$row['age'].'
        </td>
        <td class="align-middle text-center">
            '.$row['address'].'
        </td>
        <td class="align-middle text-center">
            '.$row['city'].'
        </td>
        <td class="align-middle text-center">
            '.$row['state'].'
        </td>';
        if($row['isActive']=='1'){
            $output .= '<td class="align-middle text-center"><span class="btn btn-sm btn-success">Active</span></td>';
        }
        if($row['isActive']=='0'){
            $output .= '<td class="align-middle text-center"><span class="btn btn-sm btn-danger">Inactive</span></td>';
        }
        $output .=  '<td class="align-middle text-center">
            '.$row['created_at'].'
        </td>
    </tr>
      ';  
      $slNo++;
 }  
 $output .= '</tbody>';
 $output .= '</table>';  
 echo $output;  
 ?>