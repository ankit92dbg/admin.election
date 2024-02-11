 <!-- Modal -->
 <div class="modal fade" style="z-index:9999" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">SMS PANEL</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" id="message_user_id" value="" />
                    <div class="row">
                      <div class="col-12">
                          <div id="msgId"></div>
                          <div class="mb-3">
                              <label class="label">Message Body</label>
                              <textarea style="height: 200px;" name="message_box" id="message_box" class="form-control form-control-lg" required></textarea>    
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-success" onclick="sendMessage('sss')">SEND</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal-->
            
          </div>

      <script>

      function sendMessage(val){  
        $('#overlay').show()
           $.ajax({  
                url:"../../api/message.php",  
                method:"POST",  
                // data:{AC_NO:val},  
                success:function(data){  
                  $('#overlay').hide()
                    if(!data.error)
                    {
                        $('#total_data').text(data.total_line);
                        $('#message').html('<div class="alert alert-success" style="color:#fff">Message Sent Successfully.</div>');
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
      } 
      </script>    