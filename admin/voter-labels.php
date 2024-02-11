<?php
$breadCrumbName = "Label Value";
?>
<?php include('../common/local/head.php'); ?>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
<?php include('../common/local/aside.php'); ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php include('../common/local/header.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-lg-6 d-flex justify-content-between">
                    <h6 class="mb-2">Label Value List</h6>
                </div>
                <div class="col-lg-6">
                    <a style="float:right;" class="btn btn-primary" href="add-voter-label.php?id=<?php echo $_GET['id']; ?>">Add Label Value</a>
                </div> 
                <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-4 d-flex justify-content-between">
                              <input type="text" onchange="load_data()" onkeyup="load_data()" onkeydown="load_data()" id="search_str" class="form-control" placeholder="Search by Label or Value" />
                            </div>
                            <div class="col-lg-2 justify-content-between">
                                <p style="float:right;margin-top:5%">Show Result :</p>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-between">
                                    <select id="total_records" onchange="load_data()" class="form-select">
                                        <option value="50" selected>50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>    
                            </div> 
                        </div>
                </div> 
              </div>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                    <div class="table-responsive" id="dataTbl"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            <!-- Modal -->
            <div class="modal fade" style="z-index:9999" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="delete_id" value="" />
                    <p><strong>Are you sure, you want to delete this label?</strong></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                    <button type="button" onclick="delUser()" class="btn btn-danger">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal-->
      <?php include('../common/local/footer.php'); ?>
    </div>
  </main>
  </body>
<?php include('../common/local/footer-links.php') ?>
<script>
  
 $(document).ready(function(){  
      load_data();  
       
      $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           load_data(page);  
      }); 
      $(document).on('click', '.dp-menu', function(event) {
        $(this).next('.drop-menu').toggle();
        event.stopPropagation();
      }); 
      function changeStatus(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{user_id:val,action:"change_status"},  
                success:function(data){  
                    load_data()
                }  
           })  
      }
 }); 
 function load_data(page)  
      {  
        if(page!=''){
          $('#overlay').show()
          let total_records = $('#total_records').val()
          let search_str = $('#search_str').val()
            $.ajax({  
                  url:"../ajax/voter-labels.php",  
                  method:"POST",  
                  data:{page:page,total_records:total_records,search_str:search_str,user_id:"<?php echo $_GET['id']; ?>"},  
                  success:function(data){  
                      $('#dataTbl').html(data);  
                      $('#overlay').hide()
                  }  
            })  
        }   
      } 



      function delUser(){
        $('#overlay').show()
        $('#exampleModal').modal('hide');          
        $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{id:$('#delete_id').val(),action:"delete_label"},  
                success:function(data){  
                    load_data()
                }  
           }) 
      }

      function deleteUser(id){
        $('#delete_id').val(id)
        $('#exampleModal').modal('show');          
      }

</script>