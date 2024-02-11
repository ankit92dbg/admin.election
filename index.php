<?php include('common/head.php'); ?>
<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  <form id="loginForm" role="form" method="post">
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" required>
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
                    </div>
                    <div class="text-center">
                      <button type="button" id="loginBtn" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div id="successMsg" class="alert alert-success" role="alert" style="display:none;color:#fff">
                  Logged in successfully!
                </div>
                <div id="warningMsg" class="alert alert-danger" role="alert" style="display:none;color:#fff">
                  
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/img/all_party.avif');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Admin and leader's login panel"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  </body>
<?php include('common/footer-links.php') ?>
<script>
      $(document).ready(function() {
        $('#loginBtn').on('click', function (e) {
          e.preventDefault();
          $('#overlay').show()
          let formData = $('#loginForm').serialize()
          $.ajax({
            type: 'post',
            url: 'ajax/login.php',
            data: formData,
            success: function (response) {
              let resp = JSON.parse(response,true)
              setTimeout(() => {
                $('#overlay').hide()    
                if(resp.message=='success'){
                  $('#successMsg').show()
                  if(resp.user_type==0){
                    window.location.href="admin/dashboard.php";
                  }
                  if(resp.user_type==1){
                    window.location.href="leader/dashboard.php";
                  }
                  if(resp.user_type==2){
                    window.location.href="subleader/dashboard.php";
                  }
                }else{
                  $('#warningMsg').html(resp.message)
                  $('#warningMsg').show()
                  setTimeout(() => {
                    $('#warningMsg').hide()
                  }, 4000);
                }            
              }, 1000);
              
            }
          });

        });

      });
    </script>