<?php  
 session_start();
include ('../config/conn.php');

 $record_per_page = $_POST["total_records"];  
 $search_str = $_POST["search_str"];  
 $user_id = $_POST["user_id"];  
 $page = '';  
 $slNo = '';  
 $output = '';  
 $first=1;
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
 if($search_str==''){
    $query = "SELECT * FROM voters_data WHERE leader_id='$user_id' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
 }else{
    $query = "SELECT * FROM voters_data WHERE leader_id='$user_id' AND FM_NAME_EN LIKE '%".$search_str."%' OR LASTNAME_EN LIKE '%".$search_str."%' OR EPIC_NO LIKE '%".$search_str."%' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
 }
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
                <th>Action</th>
            </tr>
        </thead> 
        <tbody>
 ";  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>
        <td class="align-middle">
            '.$slNo.'
        </td>
        <td class="align-middle">
            '.$row['AC_NO'].'
        </td>
        <td class="align-middle">
            '.$row['PART_NO'].'
        </td>
        <td class="align-middle">
            '.$row['SECTION_NO'].'
        </td>
        <td class="align-middle">
            '.$row['SLNOINPART'].'
        </td>
        <td class="align-middle">
            '.$row['C_HOUSE_NO'].'
        </td>
        <td class="align-middle">
            '.$row['C_HOUSE_NO_V1'].'
        </td>
        <td class="align-middle">
            '.$row['FM_NAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['LASTNAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['FM_NAME_V1'].'
        </td>
        <td class="align-middle">
            '.$row['LASTNAME_V1'].'
        </td>
        <td class="align-middle">
            '.$row['RLN_TYPE'].'
        </td>
        <td class="align-middle">
            '.$row['RLN_FM_NM_EN'].'
        </td>
        <td class="align-middle">
            '.$row['RLN_L_NM_EN'].'
        </td>
        <td class="align-middle">
            '.$row['RLN_FM_NM_V1'].'
        </td>
        <td class="align-middle">
            '.$row['RLN_L_NM_V1'].'
        </td>
        <td class="align-middle">
            '.$row['EPIC_NO'].'
        </td>
        <td class="align-middle">
            '.$row['GENDER'].'
        </td>
        <td class="align-middle">
            '.$row['AGE'].'
        </td>
        <td class="align-middle">
            '.$row['DOB'].'
        </td>
        <td class="align-middle">
            '.$row['MOBILE_NO'].'
        </td>
        <td class="align-middle">
            '.$row['AC_NAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['AC_NAME_V1'].'
        </td>
        <td class="align-middle">
            '.$row['SECTION_NAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['SECTION_NAME_V1'].'
        </td>
        <td class="align-middle">
            '.$row['PSBUILDING_NAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['PSBUILDING_NAME_V1'].'
        </td>
        <td class="align-middle">
            '.$row['PART_NAME_EN'].'
        </td>
        <td class="align-middle">
            '.$row['PART_NAME_V1'].'
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
      $slNo++;
 }  
 $output .= '</tbody>';
 $output .= '</table><br /><div align="center">';  
//  $output .= '<nav aria-label="Page navigation example">';
//  $output .= ' <ul class="pagination">';
if($search_str==''){
 $page_query = "SELECT * FROM voters_data WHERE leader_id='$user_id' ORDER BY id DESC";  
}else{
 $page_query = "SELECT * FROM voters_data WHERE leader_id='$user_id' AND FM_NAME_EN LIKE '%".$search_str."%' OR LASTNAME_EN LIKE '%".$search_str."%' OR EPIC_NO LIKE '%".$search_str."%' ORDER BY id DESC";  
}
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
//  $counter = 1;
//  for($i=1; $i<=$total_pages; $i++)  
//  {  
//     if($counter == 4 && $page==1 ){
//         $output .= ' ...';
//     }else if($counter < 4 || $counter > ($total_pages-3)){
//         if($page==$i){
//             $output .= "<li class='page-item active'><a class='page-link' href='javascript:void(0);'><span class='pagination_link' style='cursor:pointer; padding:6px; color:#fff' slNo='".$slNo."' id='".$i."'>".$i."</span></a></li>";  
//           }else{
//             $output .= "<li class='page-item'><a class='page-link' href='javascript:void(0);'><span class='pagination_link' style='cursor:pointer; padding:6px;' slNo='".$slNo."' id='".$i."'>".$i."</span></a></li>";  
//           }  
//     }
//     $counter++;
//  }  
//  $output .= '</ul></nav></div><br /><br />';  
$output .= '
  		<ul class="pagination">
	';

	$total_links = ceil($total_records/$record_per_page);

	$previous_link = '';

	$next_link = '';

	$page_link = '';
    $page_array = []; 

	if($total_links > 4)
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

			if($next_id >= $total_links)
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