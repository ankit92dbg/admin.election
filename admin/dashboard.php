<?php
$breadCrumbName = "Dashboard";
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
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Candidate</p>
                    <h5 class="font-weight-bolder" id="totalBoothWorkers">
                      0
                    </h5>
                    <!-- <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+55%</span>
                      since yesterday
                    </p> -->
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <!-- <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Polling Booth</p>
                    <h5 class="font-weight-bolder" id="totalPollingBooth">
                      0
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+3%</span>
                      since last week
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fa fa-bar-chart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <!-- <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Male <br/>Voters</p>
                    <h5 class="font-weight-bolder" id="totalMaleVoters">
                      0
                    </h5>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder">-2%</span>
                      since last quarter
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="fa fa-male text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <div class="col-xl-3 col-sm-6">
          <!-- <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Female <br/>Voters</p>
                    <h5 class="font-weight-bolder" id="totalFemaleVoters">
                      0
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="fa fa-female text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <!-- <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Sales overview</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
              <div class="carousel-inner border-radius-lg h-100">
                <div class="carousel-item h-100 active" style="background-image: url('../assets/img/carousel-1.jpg');
                  background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-camera-compact text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Get started with Argon</h5>
                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-2.jpg');
                  background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                    <p>That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-3.jpg');
                  background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-trophy text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div> -->
      <!-- <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Latest 10 uploaded voters :</h6>
              </div>
            </div>
            <div class="table-responsive">
              <div class="table-responsive" id="dataVotersTbl"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Leaders List(latest 10) :</h6>
            </div>
            <div class="card-body p-3">
            <div class="table-responsive" id="dataLeadersTbl"></div>
            </div>
          </div>
        </div>
      </div> -->
      
      <div class="container">
        <div class="row" style="margin-top: 134px;padding-bottom:50px">
          <div class="col-sm-2">
           
          </div>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-3">
                <div class="img-center" style="background: #ffeded;
    padding: 10px;">
                <img src="../assets/img/icons/1.png" class="img-fluid" width="50px">
                  <div>
                  <p style="text-align:center;margin-top:7px;padding: 0px;margin: 7px auto auto auto;"> Constituency 1</p>
                   </div>
                </div>
              </div>
              
              
              <div class="col-sm-3">
                <div class="img-center" style="background: #ffeded;
    padding: 10px;">
                <img src="../assets/img/icons/2.png" class="img-fluid" width="50px">
                  <div>
                     <p style="text-align:center;margin-top:7px;padding: 0px;margin: 7px auto auto auto;"> Constituency 2</p>
                   
                  </div>
                </div>
              </div>
              
              <div class="col-sm-3">
                <div class="img-center" style="background: #ffeded;
    padding: 10px 6px;">
                <img src="../assets/img/icons/3.png" class="img-fluid" width="50px">
                  <div>
                     <p style="text-align:center;margin-top:7px;padding: 0px;margin: 7px auto auto auto;"> Constituency 3</p>
                    
                  </div>
                </div>
              </div>
              
              <div class="col-sm-3">
                <div class="img-center" style="background: #ffeded;
    padding: 10px;">
                <img src="../assets/img/icons/4.png" class="img-fluid" width="50px">
                  <div>
                      <p style="text-align:center;margin-top:7px;padding: 0px;margin: 7px auto auto auto;">Constituency 4</p>
                   
                  </div>
                </div>
              </div>
              
              
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
      load_voters(); 
      load_leaders(); 
      loadDashboardData();  
 }); 
 function load_voters()  
      {  
          $('#overlay').show()
          let total_records = $('#total_records').val()
          let search_str = $('#search_str').val()
            $.ajax({  
                  url:"../ajax/dashboard-voters.php",  
                  method:"POST",  
                  // data:{page:page,total_records:total_records,search_str:search_str},  
                  success:function(data){  
                      $('#dataVotersTbl').html(data);  
                      $('#overlay').hide()
                  }  
            })  
      } 
      function load_leaders()  
      {  
          $('#overlay').show()
          let total_records = $('#total_records').val()
          let search_str = $('#search_str').val()
            $.ajax({  
                  url:"../ajax/dashboard-leaders.php",  
                  method:"POST",  
                  // data:{page:page,total_records:total_records,search_str:search_str},  
                  success:function(data){  
                      $('#dataLeadersTbl').html(data);  
                      $('#overlay').hide()
                  }  
            })  
       
      } 
      function loadDashboardData(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{action:"dashboard_data"},  
                success:function(data){  
                  $('#totalBoothWorkers').html(data.dashboardData.totalBoothWorkers)
                  $('#totalPollingBooth').html(data.dashboardData.totalPollingBooth)
                  $('#totalMaleVoters').html(data.dashboardData.totalMaleVoters)
                  $('#totalFemaleVoters').html(data.dashboardData.totalFemaleVoters)
                      $('#overlay').hide()
                }  
           })  
      }
</script>