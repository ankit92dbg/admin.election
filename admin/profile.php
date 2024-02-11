<?php
$breadCrumbName = "Profile";
?>
<?php include('../common/local/head.php'); ?>
<body class="g-sidenav-show bg-gray-100">
  <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
    <span class="mask bg-primary opacity-6"></span>
  </div>
  <?php include('../common/local/aside.php'); ?>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <?php include('../common/local/header.php'); ?>
    <!-- End Navbar -->
    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="" alt="profile_image" class="w-100 border-radius-lg shadow-sm prof-image">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1" id="full_name">
                
              </h5>
              <p class="mb-0 font-weight-bold text-sm" id="user_designation">
                
              </p>
            </div>
          </div>
          <!-- <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <i class="ni ni-app"></i>
                    <span class="ms-2">App</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-email-83"></i>
                    <span class="ms-2">Messages</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-settings-gear-65"></i>
                    <span class="ms-2">Settings</span>
                  </a>
                </li>
              </ul>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <form  id="userForm" enctype="multipart/form-data" role="form" method="post">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Edit Profile</p>
                  <button type="submit" id="loginBtn" class="btn btn-primary btn-sm ms-auto">Save</button>
                </div>
              </div>
              <div class="col-md-12">
                <span id="message"></span>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">User Information</p>
                <div class="row">              
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">First name</label>
                      <input type="text" id="f_name" name="f_name" class="form-control form-control-lg" placeholder="First Name" aria-label="Email" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Last name</label>
                      <input type="text" id="l_name" name="l_name" class="form-control form-control-lg" placeholder="Last Name" aria-label="Password" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">Age</label>
                      <input type="number" id="age" name="age" class="form-control form-control-lg" placeholder="Age" aria-label="Password" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">Desgination</label>
                      <input type="text" id="designation" name="designation" class="form-control form-control-lg" placeholder="Desgination" aria-label="Password" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">Profile Image</label>
                      <input type="file" name="profile_image" class="form-control form-control-lg" placeholder="" aria-label="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">Password</label>
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');">
                    </div>
                  </div>
                  
                </div>
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Contact Information</p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Phone No.</label>
                      <input type="number" id="phone" name="phone" class="form-control form-control-lg" placeholder="Phone Number" aria-label="Password" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Email address</label>
                      <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Password" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">State</label>
                      <select id="state" onchange="load_city(this.value)" name="state" class="form-select" required>
                        <option value="" selected>Please Select</option>
                      </select>   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="label">City</label>
                        <select id="city" name="city" class="form-select" required>
                          <option value="" selected>Please Select</option>
                        </select>   
                    </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                            <label class="label">Address</label>
                            <textarea name="address" id="address" class="form-control form-control-lg" required></textarea>
                        </div>
                    </div>
                  <!-- <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Country</label>
                      <input class="form-control" type="text" value="United States">
                    </div>
                  </div> -->
                  <!-- <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Postal code</label>
                      <input class="form-control" type="text" value="437300">
                    </div>
                  </div> -->
                </div>
                <!-- <hr class="horizontal dark">
                <p class="text-uppercase text-sm">About me</p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">About me</label>
                      <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile">
              <img src="../assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-4 col-lg-4 order-lg-2">
                  <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                    <a href="javascript:;">
                      <img src="" class="rounded-circle img-fluid border border-2 border-white prof-image">
                    </a>
                  </div>
                </div>
              </div>
              <!-- <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                <div class="d-flex justify-content-between">
                  <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                  <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                  <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                  <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
                </div>
              </div> -->
              <!-- <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <div class="d-flex justify-content-center">
                      <div class="d-grid text-center">
                        <span class="text-lg font-weight-bolder">22</span>
                        <span class="text-sm opacity-8">Friends</span>
                      </div>
                      <div class="d-grid text-center mx-4">
                        <span class="text-lg font-weight-bolder">10</span>
                        <span class="text-sm opacity-8">Photos</span>
                      </div>
                      <div class="d-grid text-center">
                        <span class="text-lg font-weight-bolder">89</span>
                        <span class="text-sm opacity-8">Comments</span>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="text-center mt-4">
                  <h5 id="u_name">
                  
                  </h5>
                  <div class="h6 font-weight-300" id="u_address">
                    
                  </div>
                  <div class="h6 mt-4" id="u_designation">
                    
                  </div>
                  <div>
                    <!-- <i class="ni education_hat mr-2"></i>University of Computer Science -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <?php include('../common/local/footer.php'); ?>
    </div>
  </div>
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
                url:"../ajax/edit-profile.php",
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
                        $('#message').html('<div class="alert alert-success" style="color:#fff">Profile Updated Successfully.</div>');
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
   })   
 function load_data()  
      {  
        $('#overlay').show()
        $(".prof-image").attr("src","../assets/img/dummy-user.jpg");
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{action:"user_data",user_id:"<?php echo $_SESSION['user_id']; ?>"},  
                success:function(data){  
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

                    //City
                    let option_city = [];
                    option_city += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.city.length; i++){
                        option_city += `<option value="${data.city[i].id}">${data.city[i].city}</option>`
                    }
                    $('#city').html(option_city)
                    $('#state').html(optionState)
                    $('#f_name').val(data.userData.f_name)
                    $('#l_name').val(data.userData.l_name)
                    $('#full_name').html(data.userData.f_name+' '+data.userData.l_name)
                    $('#u_name').html(data.userData.f_name+' '+data.userData.l_name+'<span class="font-weight-light">, '+data.userData.age+'</span>')
                    $('#email').val(data.userData.email)
                    $('#phone').val(data.userData.phone)
                    $('#age').val(data.userData.age)
                    $('#address').val(data.userData.address)
                    $('#designation').val(data.userData.designation)
                    $('#user_designation').html(data.userData.designation)
                    $('#state option[value="'+data.userData.state+'"]').attr("selected", "selected");
                    $('#city option[value="'+data.userData.city+'"]').attr("selected", "selected");
                    $('#u_address').html('<i class="fa fa-location-arrow mr-2"></i> '+$('#state').find('option:selected').text()+','+$('#city').find('option:selected').text())
                    $('#u_designation').html('<i class="fa fa-briefcase mr-2"></i> '+data.userData.designation)
                    if(data.userData.profile_image!=null){
                      $(".prof-image").attr("src","../uploads/"+data.userData.profile_image);
                    }
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