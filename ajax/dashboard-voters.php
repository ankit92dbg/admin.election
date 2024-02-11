<?php  
 session_start();
include ('../config/conn.php');
$slNo=1;
 $query = "SELECT * FROM voters_data ORDER BY id DESC LIMIT 10";  
 $result = mysqli_query($conn, $query);  
 $output .= "  
      <table class='table align-items-center mb-0'>  
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>AC_NO</th>
                <th>PART_NO</th>
                <th>SECTION_NO</th>
                <th>SLNOINPART</th>
                <th>C_HOUSE_NO</th>
                <th>C_HOUSE_NO_V1</th>
                <th>FM_NAME_EN</th>
                <th>LASTNAME_EN</th>
                <th>FM_NAME_V1</th>
                <th>LASTNAME_V1</th>
                <th>RLN_TYPE</th>
                <th>RLN_FM_NM_EN</th>
                <th>RLN_L_NM_EN</th>
                <th>RLN_FM_NM_V1</th>
                <th>RLN_L_NM_V1</th>
                <th>EPIC_NO</th>
                <th>GENDER</th>
                <th>AGE</th>
                <th>DOB</th>
                <th>MOBILE_NO</th>
                <th>AC_NAME_EN</th>
                <th>AC_NAME_V1</th>
                <th>SECTION_NAME_EN</th>
                <th>SECTION_NAME_V1</th>
                <th>PSBUILDING_NAME_EN</th>
                <th>PSBUILDING_NAME_V1</th>
                <th>PART_NAME_EN</th>
                <th>PART_NAME_V1</th>
            </tr>
        </thead> 
        <tbody>
 ";  
 while($row = mysqli_fetch_array($result))  
 {  
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
            '.$row['SECTION_NO'].'
        </td>
        <td class="align-middle text-center">
            '.$row['SLNOINPART'].'
        </td>
        <td class="align-middle text-center">
            '.$row['C_HOUSE_NO'].'
        </td>
        <td class="align-middle text-center">
            '.$row['C_HOUSE_NO_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['FM_NAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['LASTNAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['FM_NAME_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['LASTNAME_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['RLN_TYPE'].'
        </td>
        <td class="align-middle text-center">
            '.$row['RLN_FM_NM_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['RLN_L_NM_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['RLN_FM_NM_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['RLN_L_NM_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['EPIC_NO'].'
        </td>
        <td class="align-middle text-center">
            '.$row['GENDER'].'
        </td>
        <td class="align-middle text-center">
            '.$row['AGE'].'
        </td>
        <td class="align-middle text-center">
            '.$row['DOB'].'
        </td>
        <td class="align-middle text-center">
            '.$row['MOBILE_NO'].'
        </td>
        <td class="align-middle text-center">
            '.$row['AC_NAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['AC_NAME_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['SECTION_NAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['SECTION_NAME_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['PSBUILDING_NAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['PSBUILDING_NAME_V1'].'
        </td>
        <td class="align-middle text-center">
            '.$row['PART_NAME_EN'].'
        </td>
        <td class="align-middle text-center">
            '.$row['PART_NAME_V1'].'
        </td>
       
    </tr>
      ';  
      $slNo++;
 }  
 $output .= '</tbody>';
 $output .= '</table>';
 echo $output;  
 ?>