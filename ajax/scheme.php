<style>td {

width: 100px;
overflow: hidden;
}
</style>
<?php  
session_start();
include ('../config/conn.php');

$record_per_page = $_POST["total_records"];  
$search_str = $_POST["search_str"];  
$leader_id = $_POST['leader_id'];
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
  $query = "SELECT * FROM labharthi_scheme WHERE leader_id='$leader_id' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
}else{
  $query = "SELECT * FROM labharthi_scheme WHERE leader_id='$leader_id' AND scheme_name LIKE '%".$search_str."%' ORDER BY id DESC LIMIT $start_from, $record_per_page";  
}
$result = mysqli_query($conn, $query);  
$output .= "  
    <table class='table align-items-center mb-0'  CELLPADDING='2' CELLSPACING='2' WIDTH='800'>  
      <thead>
          <tr>
              <th>SN.</th>
              <th>Scheme Name</th>
              <th>Type</th>
              <th>Created On</th>
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
          '.$row['scheme_name'].'
      </td>';
      if($row['scheme_type']=='0'){
          $output .= '<td class="align-middle">Labharthi Center</td>';
      }
      if($row['scheme_type']=='1'){
          $output .= '<td class="align-middle">Labharthi State</td>';
      }
      if($row['scheme_type']=='2'){
        $output .= '<td class="align-middle">Labharthi Candidate</td>';
    }
      $output .=  '<td class="align-middle">
          '.$row['created_at'].'
      </td>
      <td class="align-middle">
          <div class="dp">
              <a class="btn dp-menu" type="button" data-toggle="dropdown" aria-expanded="false">
                  <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                      <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                  </svg>
              </a>
              <ul class="dropdown-menu drop-menu dropdown-menu-dark bg-dark" role="menu" style="right:0">
                  <li><a class="dropdown-item text-danger" onclick="deleteUser('.$row['id'].');" href="javascript:void(0);">Delete</a></li>
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
$page_query = "SELECT * FROM user_tbl WHERE user_type=1 ORDER BY id DESC";  
}else{
$page_query = "SELECT * FROM  user_tbl WHERE user_type=1 AND (f_name LIKE '%".$search_str."%' OR l_name LIKE '%".$search_str."%' OR email LIKE '%".$search_str."%' OR phone LIKE '%".$search_str."%') ORDER BY id DESC";  
}
$page_result = mysqli_query($conn, $page_query);  
$total_records = mysqli_num_rows($page_result);  
if($total_records==0){
  $total_pages=0;
}else{
  $total_pages = ceil($total_records/$record_per_page);  
}
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
  if($total_records==0){
      $total_links=0;
   }else{
      $total_links = ceil($total_records/$record_per_page);
   }

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