<?php
$breadCrumbName = "Update Candidate";
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
                <div class="col-lg-2 d-flex justify-content-between">
                    <h6 class="mb-2" style="margin-top:5%;">Update Candidate</h6>
                </div>   
              </div>
            </div>
            <div class="card-body p-3">
              <form  id="userForm" enctype="multipart/form-data" role="form" method="post">
                <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>" />
                <div class="row">
                    <div class="col-12">
                        <span id="message"></span>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                        <label class="label">Assembly Name</label>
                        <input type="text" name="assembly_name" id="assembly_name" class="form-control form-control-lg" placeholder="Assembly Name" aria-label="Email" required="">
                        </div>
                    </div>
                    <!-- <div class="col-4">
                        <div class="mb-3">
                            <label class="label">SECTION_NO</label>
                            <select id="SECTION_NO" name="SECTION_NO[]"  class="form-select" multiple style="max-height: 90px;overflow-x: scroll;" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div> -->
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">First Name</label>
                            <input type="text" id="f_name" name="f_name" class="form-control form-control-lg" placeholder="First Name" aria-label="Email" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Last Name</label>
                            <input type="text" id="l_name" name="l_name" class="form-control form-control-lg" placeholder="Last Name" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Phone No.</label>
                            <input type="number" id="phone" name="phone" class="form-control form-control-lg" placeholder="Email" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Age</label>
                            <input type="number" id="age" name="age" class="form-control form-control-lg" placeholder="Age" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Desgination</label>
                            <input type="text" id="designation" name="designation" class="form-control form-control-lg" placeholder="Desgination" aria-label="Password" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">State</label>
                            <select id="state" onchange="load_city(this.value)" name="state" class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">City</label>
                            <select id="city" name="city" class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Address</label>
                            <textarea name="address" id="address" class="form-control form-control-lg" required></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control form-control-lg" placeholder="" aria-label="Password">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" >
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="loginBtn" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                    <div class="col-4">
                        <a href="leaders.php" class="btn btn-lg btn-secondary btn-lg w-100 mt-4 mb-0">Back</a>
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
                url:"../ajax/edit-leaders.php",
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
                    if(!data.error)
                    {
                        $('#total_data').text(data.total_line);
                        $('#message').html('<div class="alert alert-success" style="color:#fff">Candidate Updated Successfully.</div>');
                       setTimeout(() => {
                            window.location.href="leaders.php"
                        }, 2000);
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
                data:{action:"user_data",user_id:"<?php echo $_GET['id']; ?>"},  
                success:function(data){  
                    //AC_NO
                    let option = [];
                    let optionState = [];
                    optionState += '<option value="" selected>Please Select</option>'
                    option += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.AC_NO.length; i++){
                        option += `<option value="${data.AC_NO[i].AC_NO}">${data.AC_NO[i].AC_NO}</option>`
                    }
                    for(let j=0; i < data.state.length; i++){
                        optionState += `<option value="${data.state[i].id}">${data.state[i].name}</option>`
                    }

                    //PART_NO
                    let option_part_no = [];
                    option_part_no += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.PART_NO.length; i++){
                        option_part_no += `<option value="${data.PART_NO[i].PART_NO}">${data.PART_NO[i].PART_NO}</option>`
                    }
                    $('#PART_NO').html(option_part_no)
                    if(data.PART_NO.length==0){
                     $('#SECTION_NO').html(option_part_no)
                    }

                    //SECTION_NO
                    let option_section_no = [];
                    for(let i=0; i < data.SECTION_NO.length; i++){
                        option_section_no += `<option value="${data.SECTION_NO[i].SECTION_NO}">${data.SECTION_NO[i].SECTION_NO}</option>`
                    }

                    //City
                    let option_city = [];
                    option_city += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.city.length; i++){
                        option_city += `<option value="${data.city[i].id}">${data.city[i].city}</option>`
                    }
                    $('#city').html(option_city)
                    // $('#SECTION_NO').html(option_section_no)
                    // $('#AC_NO').html(option)
                    $('#state').html(optionState)
                    $('#assembly_name').val(data.userData.assembly_name)
                    $('#f_name').val(data.userData.f_name)
                    $('#l_name').val(data.userData.l_name)
                    $('#email').val(data.userData.email)
                    $('#phone').val(data.userData.phone)
                    $('#age').val(data.userData.age)
                    $('#address').val(data.userData.address)
                    $('#designation').val(data.userData.designation)

                    $('#AC_NO option[value="'+data.userData.AC_NO+'"]').attr("selected", "selected");
                    $('#PART_NO option[value="'+data.userData.PART_NO+'"]').attr("selected", "selected");
                    $('#state option[value="'+data.userData.state+'"]').attr("selected", "selected");
                    $('#city option[value="'+data.userData.city+'"]').attr("selected", "selected");
                    for(let i=0; i<data.userData.selectedBooth.length;i++){
                        $('#SECTION_NO option[value="'+data.userData.selectedBooth[i].SECTION_NO+'"]').attr("selected", "selected");
                    }

                    $('#overlay').hide()
                }  
           })  
      } 

      function load_part_no(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{AC_NO:val},  
                success:function(data){  
                    let option = [];
                    option += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.PART_NO.length; i++){
                        option += `<option value="${data.PART_NO[i].PART_NO}">${data.PART_NO[i].PART_NO}</option>`
                    }
                    $('#PART_NO').html(option)
                    if(data.PART_NO.length==0){
                     $('#SECTION_NO').html(option)
                    }
                    $('#overlay').hide()
                }  
           })  
      } 

      function load_section_no(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{AC_NO:$('#AC_NO').val(), PART_NO:val},  
                success:function(data){  
                    let option = [];
                    for(let i=0; i < data.SECTION_NO.length; i++){
                        option += `<option value="${data.SECTION_NO[i].SECTION_NO}">${data.SECTION_NO[i].SECTION_NO}</option>`
                    }
                    $('#SECTION_NO').html(option)
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