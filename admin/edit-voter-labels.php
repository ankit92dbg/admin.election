<?php
$breadCrumbName = "Update Label Value";
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
                <div class="col-lg-3 d-flex justify-content-between">
                    <h6 class="mb-2" style="margin-top:5%;">Update Label Value</h6>
                </div>   
              </div>
            </div>
            <div class="card-body p-3">
              <form  id="userForm" enctype="multipart/form-data" role="form" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <div class="row">
                    <div class="col-12">
                        <span id="message"></span>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Label</label>
                            <input type="text" id="label" name="label" class="form-control form-control-lg" placeholder="Label" aria-label="Email" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Value</label>
                            <input type="text" id="value" name="value" class="form-control form-control-lg" placeholder="Value" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <button type="submit" id="loginBtn" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                    <div class="col-4">
                        <a href="voter-labels.php?id=<?php echo $_GET['leader_id']; ?>" class="btn btn-lg btn-secondary btn-lg w-100 mt-4 mb-0">Back</a>
                    </div>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <?php include('../common/local/footer.php'); ?>
    </div>
  </main>
  </body>
<?php include('../common/local/footer-links.php') ?>
<script>
 $(document).ready(function(){  
      load_data();  
      $('#userForm').on('submit', function(event){
            $('#overlay').show()
            $('#message').html('');
            event.preventDefault();
            $.ajax({
                url:"../ajax/edit-voter-label.php",
                method:"POST",
                data: new FormData(this),
                dataType:"json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('#import').attr('disabled','disabled');
                    $('#import').val('Importing');
                },
                success:function(data)
                {
                    $('#overlay').hide()
                    if(data.error==''){
                        $('#userForm')[0].reset();
                    }
                    if(!data.error)
                    {
                        $('#total_data').text(data.total_line);
                        $('#message').html('<div class="alert alert-success" style="color:#fff">Label And Value Updated Successfully.</div>');
                    }
                    if(data.error)
                    {
                        $('#message').html('<div class="alert alert-danger" style="color:#fff">'+data.error+'</div>');
                    }
                    setTimeout(() => {
                        $('#message').html('')
                    }, 5000);
                }
            })
        });
 }); 
 function load_data(page)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{action:'leader_voter_label',id:"<?php echo $_GET['id']; ?>"},  
                success:function(data){  
                    $('#label').val(data.voter_label[0].label)
                    $('#value').val(data.voter_label[0].value)
                    $('#overlay').hide()
                }  
           })  
      } 


      function load_city(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{state:val},   
                success:function(data){  
                    let option = [];
                    option += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.city.length; i++){
                        option += `<option value="${data.city[i].id}">${data.city[i].city}</option>`
                    }
                    $('#city').html(option)
                    $('#overlay').hide()
                }  
           })  
      } 
      
</script>