<?php
$breadCrumbName = "Upload CSV";
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
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Upload file in CSV Format : <a href="download-sample.php" target="_blank"><i class="fa fa-file"></i> Sample Format</a></h6>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="col-12">
                <div class="formbold-main-wrapper">
                    <div class="formbold-form-wrapper">
                        <form method="POST" id="uploadForm" enctype="multipart/form-data" method="POST">
                            <div class="mb-6 pt-4">
                                <label class="formbold-form-label formbold-form-label-2">
                                Upload File(.CSV)
                                </label>

                                <div class="formbold-mb-5 formbold-file-input">
                                    <input type="file" name="file" id="file" />
                                    <input type="hidden" name="leader_id" value="<?php echo $_GET['id']; ?>" id="leader_id" />
                                    <input type="hidden" name="job_id" value="<?php echo uniqid(); ?>" id="job_id" />
                                    <label for="file">
                                        <div>
                                        <!-- <span class="formbold-drop-file"> Drop files here </span>
                                        <span class="formbold-or"> Or </span> -->
                                        <span class="formbold-browse"> Browse </span>
                                        </div>
                                    </label>
                                </div>

                                <!-- <div class="formbold-file-list formbold-mb-5">
                                    <div class="formbold-file-item">
                                        <span class="formbold-file-name"> banner-design.png </span>
                                        <button>
                                        <svg
                                            width="10"
                                            height="10"
                                            viewBox="0 0 10 10"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                            fill="currentColor"
                                            />
                                            <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                            fill="currentColor"
                                            />
                                        </svg>
                                        </button>
                                    </div>
                                </div> -->

                                <!-- <div class="formbold-file-list formbold-mb-5">
                                    <div class="formbold-file-item">
                                        <span class="formbold-file-name"> banner-design.png </span>
                                        <button>
                                        <svg
                                            width="10"
                                            height="10"
                                            viewBox="0 0 10 10"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                            fill="currentColor"
                                            />
                                            <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                            fill="currentColor"
                                            />
                                        </svg>
                                        </button>
                                    </div>
                                    <div class="formbold-progress-bar">
                                        <div class="formbold-progress"></div>
                                    </div>
                                </div> -->

                                <div class="form-group" id="process" style="display:none;">
                                    <div style="height:20px" class="progress">
                                        <div style="height:20px" class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <span id="total_data">0</span>
                                        </div>
                                    </div>    
                                </div>
                                <span id="message1"></span>
                                <span id="message" style="margin-top:2%"></span>
                            </div>

                            <div>
                                <button type="submit" id="uploadBtn" class="formbold-btn w-full">Upload File</button>
                            </div>
                        </form>
                    </div>
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
    let timer;
    let percent=0;
    $('#uploadForm').on('submit', function(event){
        // $('#overlay').show()
        $('#process').show()
        $('.progress-bar').css("width",'0%')
        $('#message1').html('Please wait while we are uploading your data...')
        $('#total_data').html('0%')
        $('#uploadMsg').show()
        $('#message').html('');
        $('#uploadBtn').hide()
        event.preventDefault();
        $.ajax({
            xhr: function()
            {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                    var percentCompleteUpload = (evt.loaded / evt.total)*1000;
                    percentCompleteUpload = percentCompleteUpload.toFixed(2)
                     if(parseFloat(percentCompleteUpload)<=parseFloat(100.00)){
                        $('.progress-bar').css("width",'0%')
                        $('#total_data').html('0%')
                        $('#message1').html('Please do not refresh while we are uploading your file...')
                    }else{
                        $('.progress-bar').css("width",'0%')
                        $('#total_data').html('0%')
                    }
                    //Do something with upload progress
                    console.log("up->",percentCompleteUpload);
                }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                    console.log('evt--->',evt,evt.lengthComputable)
                if (evt.lengthComputable) {
                    var percentComplete = (evt.loaded / evt.total)*1000
                    percentComplete = percentComplete.toFixed(2)
                    if(parseFloat(percentComplete)<=parseFloat(100.00)){
                        $('.progress-bar').css("width",percentComplete+'%')
                        $('#total_data').html(percentComplete+'%')
                        $('#message1').html('Please do not refresh while we are saving your data to database...')
                    }else{
                        $('.progress-bar').css("width",'100%')
                        $('#total_data').html('100%')
                        $('#message1').html('')
                        $('#message').html('<div class="alert alert-success" style="color:#fff">CSV File Uploaded Successfully.</div>');
                    }
                    //Do something with download progress
                    console.log('percentComplete--->',percentComplete);
                }
                }, false);
                return xhr;
            },
            url:"../ajax/upload-csv.php",
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
                $('.progress-bar').css("width",'100%')
                $('#total_data').html('100%')
                $('#message1').html('')
                $('#uploadMsg').hide()
                $('#uploadForm')[0].reset();
                $('#uploadBtn').show()
                if(data.success)
                {
                    $('#message').html('<div class="alert alert-success" style="color:#fff">CSV File Uploaded Successfully.</div>');
                }
                if(data.error)
                {
                    $('#message').html('<div class="alert alert-danger" style="color:#fff">'+data.error+'</div>');
                    $('#import').attr('disabled',false);
                    $('#import').val('Import');
                }
                setTimeout(() => {
                    $('#message').html('')
                }, 5000);
            }
        })
    });
    function checkUploading(){
    var formData = {
                'job_id': $('#job_id').val() //for get email 
            };
        $.ajax({
            url:"../ajax/check-uploading.php",
            method:"POST",
            data: formData,
            beforeSend:function(){
                $('#import').attr('disabled','disabled');
                $('#import').val('Importing');
            },
            success:function(data)
            {
                data = JSON.parse(data)
                if(data.success)
                {
                    let total_line = data.data.total_line
                    let uploaded_line = data.data.uploaded_line
                    percent = (uploaded_line/total_line)*100
                    $('#process').show()
                    $('.progress-bar').css("width",percent+'%')
                   if(total_line==total_line){
                    clearInterval(timer)
                   }
                }
              
            }
        })
}
});


</script>