<?php
$breadCrumbName = "Edit Voter";
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
                    <h6 class="mb-2" style="margin-top:5%;">Update Voter</h6>
                </div> 
                <div class="col-lg-2">
                    <div class="mb-3">
                        <button type="button" onclick="$('#exampleModalLabel').html('WhatsApp Panel');$('#exampleModal').modal('show'); " id="loginBtn" class="btn btn-primary"><i class="fa fa-whatsapp"></i> Whatsapp</button>
                    </div>
                </div> 
                <div class="col-lg-2">
                    <div class="mb-3">
                        <button type="button" onclick="$('#exampleModal').modal('show'); " id="loginBtn" class="btn btn-primary"><i class="fa fa-mail-reply"></i> Email</button>
                    </div>
                </div>  
                <div class="col-lg-2">
                    <div class="mb-3">
                        <button type="button" onclick="$('#exampleModal').modal('show'); " id="loginBtn" class="btn btn-primary"><i class="fa fa-send"></i> SMS</button>
                    </div>
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
                            <label class="label">AC_NO</label>
                            <select id="AC_NO" onchange="load_part_no(this.value)" name="AC_NO" class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">PART_NO</label>
                            <select id="PART_NO" onchange="load_section_no(this.value)" name="PART_NO" class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">SECTION_NO</label>
                            <select id="SECTION_NO" onchange="load_SLNOINPART(this.value)" name="SECTION_NO"  class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">SLNOINPART</label>
                            <select id="SLNOINPART" name="SLNOINPART"  class="form-select" required>
                                <option value="" selected>Please Select</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">C_HOUSE_NO</label>
                            <input type="text" id="C_HOUSE_NO" name="C_HOUSE_NO" class="form-control form-control-lg" placeholder="First Name" aria-label="Email" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">C_HOUSE_NO_V1</label>
                            <input type="text" id="C_HOUSE_NO_V1" name="C_HOUSE_NO_V1" class="form-control form-control-lg" placeholder="Last Name" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">FM_NAME_EN</label>
                            <input type="text" id="FM_NAME_EN" name="FM_NAME_EN" class="form-control form-control-lg" placeholder="FM_NAME_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">LASTNAME_EN</label>
                            <input type="text" id="LASTNAME_EN" name="LASTNAME_EN" class="form-control form-control-lg" placeholder="LASTNAME_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">FM_NAME_V1</label>
                            <input type="text" id="FM_NAME_V1" name="FM_NAME_V1" class="form-control form-control-lg" placeholder="FM_NAME_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">LASTNAME_V1</label>
                            <input type="text" id="LASTNAME_V1" name="LASTNAME_V1" class="form-control form-control-lg" placeholder="LASTNAME_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RLN_TYPE</label>
                            <select id="RLN_TYPE" name="RLN_TYPE"  class="form-select" >
                                <option value="" selected>Please Select</option>
                                <option value="F">F</option>
                                <option value="H">H</option>
                                <option value="L">L</option>
                                <option value="O">O</option>
                                <option value="M">M</option>
                                <option value="W">W</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RLN_FM_NM_EN</label>
                            <input type="text" id="RLN_FM_NM_EN" name="RLN_FM_NM_EN" class="form-control form-control-lg" placeholder="RLN_FM_NM_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RLN_L_NM_EN</label>
                            <input type="text" id="RLN_L_NM_EN" name="RLN_L_NM_EN" class="form-control form-control-lg" placeholder="RLN_L_NM_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RLN_FM_NM_V1</label>
                            <input type="text" id="RLN_FM_NM_V1" name="RLN_FM_NM_V1" class="form-control form-control-lg" placeholder="RLN_FM_NM_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RLN_L_NM_V1</label>
                            <input type="text" id="RLN_L_NM_V1" name="RLN_L_NM_V1" class="form-control form-control-lg" placeholder="RLN_L_NM_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">EPIC_NO</label>
                            <input type="text" id="EPIC_NO" name="EPIC_NO" class="form-control form-control-lg" placeholder="EPIC_NO" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">GENDER</label>
                            <select id="GENDER" name="GENDER"  class="form-select" >
                                <option value="" selected>Please Select</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>   
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">AGE</label>
                            <input type="number" id="AGE" name="AGE" class="form-control form-control-lg" placeholder="AGE" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">DOB</label>
                            <input type="date" id="DOB" name="DOB" class="form-control form-control-lg" placeholder="DOB" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">MOBILE_NO</label>
                            <input type="text" id="MOBILE_NO" name="MOBILE_NO" class="form-control form-control-lg" placeholder="MOBILE_NO" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">AC_NAME_EN</label>
                            <input type="text" id="AC_NAME_EN" name="AC_NAME_EN" class="form-control form-control-lg" placeholder="AC_NAME_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">AC_NAME_V1</label>
                            <input type="text" id="AC_NAME_V1" name="AC_NAME_V1" class="form-control form-control-lg" placeholder="AC_NAME_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">SECTION_NAME_EN</label>
                            <textarea name="SECTION_NAME_EN" id="SECTION_NAME_EN" class="form-control form-control-lg" ></textarea>    
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">SECTION_NAME_V1</label>
                            <textarea name="SECTION_NAME_V1" id="SECTION_NAME_V1" class="form-control form-control-lg" ></textarea>    
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">PSBUILDING_NAME_EN</label>
                            <textarea name="PSBUILDING_NAME_EN" id="PSBUILDING_NAME_EN" class="form-control form-control-lg" ></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">PSBUILDING_NAME_V1</label>
                            <textarea name="PSBUILDING_NAME_V1" id="PSBUILDING_NAME_V1" class="form-control form-control-lg" ></textarea>    
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">PART_NAME_EN</label>
                            <input type="text" id="PART_NAME_EN" name="PART_NAME_EN" class="form-control form-control-lg" placeholder="PART_NAME_EN" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">PART_NAME_V1</label>
                            <input type="text" id="PART_NAME_V1" name="PART_NAME_V1" class="form-control form-control-lg" placeholder="PART_NAME_V1" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Aadhar No.</label>
                            <input type="text" id="aadhar" name="aadhar" class="form-control form-control-lg" placeholder="Aadhar No." aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RELATIVE PART_NO</label>
                            <input type="text" id="RELATION_PART_NO" name="RELATION_PART_NO" class="form-control form-control-lg" placeholder="RELATIVE PART_NO" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">RELATION_SLNOINPART</label>
                            <input type="text" id="RELATION_SLNOINPART" name="RELATION_SLNOINPART" class="form-control form-control-lg" placeholder="RELATION_SLNOINPART" aria-label="Password" >
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Caste</label>
                            <select id="caste" name="caste" class="form-select">
                                <option value="" selected="">Please Select</option>
                                <option value="0">Hindu</option>
                                <option value="1">Muslim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Married</label>
                            <select id="isMarried" name="isMarried" class="form-select">
                                <option value="" selected="">Please Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Voter Label</label>
                            <select id="voter_label" name="voter_label" class="form-select">
                                <option value="" selected="">Please Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Political Party Associated</label>
                            <select id="political_party" name="political_party" class="form-select">
                                <option value="" selected="">Please Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Dead/Alive</label>
                            <select id="isDead" name="isDead" class="form-select">
                                <option value="" selected="">Please Select</option>
                                <option value="0">Alive</option>
                                <option value="1">Dead</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control form-control-lg" placeholder="" aria-label="Password">
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="loginBtn" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                    <div class="col-4">
                        <a href="voters.php?id=<?php echo $_GET['candidate_id']; ?>" class="btn btn-lg btn-secondary btn-lg w-100 mt-4 mb-0">Back</a>
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
                url:"../ajax/edit-voters.php",
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
                        $('#message').html('<div class="alert alert-success" style="color:#fff">Voter Updated Successfully.</div>');
                      setTimeout(() => {
                            window.location.href="voters.php?id=<?php echo $_GET['candidate_id']; ?>"
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
        // $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{action:"voter_data",voter_id:"<?php echo $_GET['id']; ?>",leader_id:"<?php echo $_GET['candidate_id']; ?>"},  
                success:function(data){  
                    //AC_NO
                    let option = [];
                    option += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.AC_NO.length; i++){
                        option += `<option value="${data.AC_NO[i].AC_NO}">${data.AC_NO[i].AC_NO}</option>`
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

                    //SLNOINPART
                    let option_SLNOINPART_no = [];
                    option_SLNOINPART_no += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.SLNOINPART.length; i++){
                        option_SLNOINPART_no += `<option value="${data.SLNOINPART[i].SLNOINPART}">${data.SLNOINPART[i].SLNOINPART}</option>`
                    }

                    //voter_label
                    let option_voter_label = [];
                    option_voter_label += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.voter_label.length; i++){
                        option_voter_label += `<option value="${data.voter_label[i].id}">${data.voter_label[i].label}</option>`
                    }

                    //voter_label
                    let option_political_party = [];
                    option_political_party += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.political_party.length; i++){
                        option_political_party += `<option value="${data.political_party[i].id}">${data.political_party[i].name}</option>`
                    }

                  
                    $('#political_party').html(option_political_party)
                    $('#voter_label').html(option_voter_label)
                    $('#SLNOINPART').html(option_SLNOINPART_no)
                    $('#SECTION_NO').html(option_section_no)
                    $('#AC_NO').html(option)
                    $('#C_HOUSE_NO').val(data.voterData.C_HOUSE_NO)
                    $('#C_HOUSE_NO_V1').val(data.voterData.C_HOUSE_NO_V1)
                    $('#FM_NAME_EN').val(data.voterData.FM_NAME_EN)
                    $('#LASTNAME_EN').val(data.voterData.LASTNAME_EN)
                    $('#FM_NAME_V1').val(data.voterData.FM_NAME_V1)
                    $('#LASTNAME_V1').val(data.voterData.LASTNAME_V1)
                    $('#RLN_FM_NM_EN').val(data.voterData.RLN_FM_NM_EN)
                    $('#RLN_L_NM_EN').val(data.voterData.RLN_L_NM_EN)
                    $('#RLN_FM_NM_V1').val(data.voterData.RLN_FM_NM_V1)
                    $('#RLN_L_NM_V1').val(data.voterData.RLN_L_NM_V1)
                    $('#EPIC_NO').val(data.voterData.EPIC_NO)
                    // $('#GENDER').val(data.voterData.GENDER)
                    $('#AGE').val(data.voterData.AGE)
                    $('#DOB').val(data.voterData.DOB)
                    $('#MOBILE_NO').val(data.voterData.MOBILE_NO)
                    $('#AC_NAME_EN').val(data.voterData.AC_NAME_EN)
                    $('#AC_NAME_V1').val(data.voterData.AC_NAME_V1)
                    $('#SECTION_NAME_EN').val(data.voterData.SECTION_NAME_EN)
                    $('#SECTION_NAME_V1').val(data.voterData.SECTION_NAME_V1)
                    $('#PSBUILDING_NAME_EN').val(data.voterData.PSBUILDING_NAME_EN)
                    $('#PSBUILDING_NAME_V1').val(data.voterData.PSBUILDING_NAME_V1)
                    $('#PART_NAME_EN').val(data.voterData.PART_NAME_EN)
                    $('#PART_NAME_V1').val(data.voterData.PART_NAME_V1)
                    $('#aadhar').val(data.voterData.aadhar)
                    $('#RELATION_PART_NO').val(data.voterData.RELATION_PART_NO)
                    $('#RELATION_SLNOINPART').val(data.voterData.RELATION_SLNOINPART)

                    $('#AC_NO option[value="'+data.voterData.AC_NO+'"]').attr("selected", "selected");
                    $('#PART_NO option[value="'+data.voterData.PART_NO+'"]').attr("selected", "selected");
                    $('#SLNOINPART option[value="'+data.voterData.SLNOINPART+'"]').attr("selected", "selected");
                    $('#SECTION_NO option[value="'+data.voterData.SECTION_NO+'"]').attr("selected", "selected");
                    $('#GENDER option[value="'+data.voterData.GENDER+'"]').attr("selected", "selected");
                    $('#RLN_TYPE option[value="'+data.voterData.RLN_TYPE+'"]').attr("selected", "selected");
                    $('#voter_label option[value="'+data.voterData.voter_label+'"]').attr("selected", "selected");
                    $('#caste option[value="'+data.voterData.caste+'"]').attr("selected", "selected");
                    $('#isMarried option[value="'+data.voterData.isMarried+'"]').attr("selected", "selected");
                    $('#political_party option[value="'+data.voterData.political_party+'"]').attr("selected", "selected");
                    $('#isDead option[value="'+data.voterData.isDead+'"]').attr("selected", "selected");


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
                    if(data.PART_NO.length==0){
                     $('#SLNOINPART').html(option)
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
                    let emptyOption = '<option value="" selected>Please Select</option>';
                    for(let i=0; i < data.SECTION_NO.length; i++){
                        option += `<option value="${data.SECTION_NO[i].SECTION_NO}">${data.SECTION_NO[i].SECTION_NO}</option>`
                    }
                    $('#SECTION_NO').html(option)
                    $('#SLNOINPART').html(emptyOption)
                    $('#overlay').hide()
                }  
           }) 
      } 

      function load_SLNOINPART(val)  
      {  
        $('#overlay').show()
           $.ajax({  
                url:"../ajax/master-data.php",  
                method:"POST",  
                data:{acNo:$('#AC_NO').val(),partNo:$('#PART_NO').val(),sectionNo:$('#SECTION_NO').val(),action:'SLNOINPART'},   
                success:function(data){  
                    let option = [];
                    option += '<option value="" selected>Please Select</option>'
                    for(let i=0; i < data.SLNOINPART.length; i++){
                        option += `<option value="${data.SLNOINPART[i].id}">${data.SLNOINPART[i].SLNOINPART}</option>`
                    }
                    $('#SLNOINPART').html(option)
                    $('#overlay').hide()
                }  
           })  
      } 
      
</script>