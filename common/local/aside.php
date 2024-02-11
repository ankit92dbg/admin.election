<?php
$url = $_SERVER['REQUEST_URI'];
$endPart = end(explode('/', rtrim($url, '/')));
$endPart = str_replace(' ', '', $endPart);
$endPart = explode('.',$endPart);
?>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="dashboard.php">
        <img src="" alt="profile_image" class="navbar-brand-img h-100" id="prof-image">
        <!-- <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
        <span class="ms-1 font-weight-bold"><?php echo $_SESSION['f_name'].' '.$_SESSION['l_name']; ?></span><br/>
        <?php if($_SESSION['user_type']!=0){ ?>
        <span style="margin-left: 21% !important;" class="ms-1 font-weight-bold">PART NO. <?php echo $_SESSION['PART_NO']; ?></span>
        <?php } ?>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='dashboard') ? 'active' : ''; ?>" href="dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='leaders' || $endPart[0]=='add-leaders' || $endPart[0]=='voters' || $endPart[0]=='edit-leaders'|| $endPart[0]=='subleaders'|| $endPart[0]=='edit-subleaders'|| $endPart[0]=='add-subleaders'|| $endPart[0]=='voter-labels'|| $endPart[0]=='add-voter-label'|| $endPart[0]=='edit-voter-labels') ? 'active' : ''; ?>" href="leaders.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user-secret text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Candidate</span>
          </a>
        </li>
        
        
        <?php if($endPart[0]=='voters'){ ?>
          <!-- <li class="nav-item" onclick="showTab('#report_2','.tab-data','.searchTab')">
          <a class="nav-link dropdown-btn" href="javascript:void(0)">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-address-book text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Report 112 <i class="fa fa-caret-down"></i></span>
          </a>
          <ul class="submenu" style="display:none">
          <li class="nav-item sub-menu" onclick="showTab('#caste','.inner-tab-data','.casteTab');$('#action').val('casteTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Caste Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#labelValue','.inner-tab-data','.labelValueTab');$('#action').val('labelValueTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Label Value Filter</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#areaWise','.inner-tab-data','.areaWiseTab');$('#action').val('areaWiseTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Area Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#partyWise','.inner-tab-data','.partyWiseTab');$('#action').val('partyWiseTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Party Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#deadList','.inner-tab-data','.deadListTab');$('#action').val('deadListTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Dead List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#birthday','.inner-tab-data','.birthdayTab');$('#action').val('birthdayTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Birthday List</a>
                        </li>
          </ul>
        </li> -->
        <li class="nav-item" onclick="showTab('#report_1','.tab-data','.searchTab');">
          <a class="nav-link dropdown-btn" href="javascript:void(0)" onclick="showTab('#searchVoter','.inner-tab-data','.searchTab');$('#action').val('searchTab');load_data()">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-search text-warning text-sm opacity-10" style="color:#000 !important"></i>
            </div>
            <span class="nav-link-text ms-1">Search Voters</span>
          </a></li>
        <li class="nav-item" onclick="showTab('#report_1','.tab-data','.searchTab');">
          <a class="nav-link dropdown-btn" href="javascript:void(0)">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-address-book text-warning text-sm opacity-10" style="color:#196ec2 !important"></i>
            </div>
            <span class="nav-link-text ms-1">Report 1 <i class="fa fa-caret-down"></i></span>
          </a>
          <ul class="submenu" style="display:none">
          <li class="nav-item sub-menu" onclick="showTab('#searchVoter','.inner-tab-data','.searchTab');$('#action').val('searchTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Search</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#alpha','.inner-tab-data','.alphaTab');$('#action').val('alphaTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Alphabetical List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#agewise','.inner-tab-data','.agewiseTab');$('#action').val('agewiseTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Agewise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#family','.inner-tab-data','.familyTab');$('#action').val('familyTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Family Report</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#familyHead','.inner-tab-data','.familyHeadTab');$('#action').val('familyHeadTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Family Head Report</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#doubleName','.inner-tab-data','.doubleNameTab');$('#action').val('doubleNameTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Double Name List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#married','.inner-tab-data','.marriedTab');$('#action').val('marriedTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Married Women Report</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#single','.inner-tab-data','.singleTab');$('#action').val('singleTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Single Voter List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#address','.inner-tab-data','.addressTab');$('#action').val('addressTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Address Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#surname','.inner-tab-data','.surnameTab');$('#action').val('surnameTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Surname Report</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#familyLabels','.inner-tab-data','.familyLabelsTab');$('#action').val('familyLabelsTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">Family Labels</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#sms','.inner-tab-data','.smsTab');$('#action').val('smsTab');load_data()">
                          <a class="nav-link" href="javascript:void(0);">SMS</a>
                        </li>
          </ul>
        </li>
        <li class="nav-item" onclick="showTab('#report_2','.tab-data','.searchTab');">
          <a class="nav-link dropdown-btn" href="javascript:void(0)">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-address-book text-warning text-sm opacity-10" style="color:#c5b212 !important"></i>
            </div>
            <span class="nav-link-text ms-1">Report 2 <i class="fa fa-caret-down"></i></span>
          </a>
          <ul class="submenu" style="display:none">
          <li class="nav-item sub-menu" onclick="showTab('#caste','.inner-tab-data','.casteTab');$('#action').val('casteTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Caste Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#labelValue','.inner-tab-data','.labelValueTab');$('#action').val('labelValueTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Label Value Filter</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#areaWise','.inner-tab-data','.areaWiseTab');$('#action').val('areaWiseTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Area Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#partyWise','.inner-tab-data','.partyWiseTab');$('#action').val('partyWiseTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Party Wise List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#deadList','.inner-tab-data','.deadListTab');$('#action').val('deadListTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Dead List</a>
                        </li>
                        <li class="nav-item sub-menu" onclick="showTab('#birthday','.inner-tab-data','.birthdayTab');$('#action').val('birthdayTab');load_data()">
                          <a class="nav-link" aria-current="page" href="javascript:void(0);">Birthday List</a>
                        </li>
          </ul>
        </li>
        <?php } ?>
        <!-- <li class="nav-item">
          <a class="nav-link"  href="leaders.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user-secret text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Reports</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='subleaders' || $endPart[0]=='add-subleaders' || $endPart[0]=='edit-subleaders') ? 'active' : ''; ?>" href="subleaders.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Cader</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='voters') ? 'active' : ''; ?>" href="voters.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-address-book text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Voters</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='upload-csv') ? 'active' : ''; ?>" href="upload-csv.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-upload text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Upload CSV</span>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link " href="./pages/rtl.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li> -->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($endPart[0]=='profile') ? 'active' : ''; ?>" href="profile.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a onClick="logout()" class="nav-link " href="javascript:void(0)">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-sign-out text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>