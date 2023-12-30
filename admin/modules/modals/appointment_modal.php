<!------------------------------------- ACCEPT -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="accept_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Accept?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="accept_form">
                <div class="modal-body">
                    <span>are you sure do you want to Accept?</span>
                    <input type="hidden" name="" id="accept_id">
     
                </div>
                <div class="modal-footer">
                      <!-- Image loader -->
                      <div id='loader' style='display: none;'>
                        <img src='../assets/images/loading.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response'></div>
                    <button class="btn btn-secondary" type="button"  data-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn_approve" class="btn btn-success">Accept</button>
                </div>
            </form>
        </div>

    </div>
</div>