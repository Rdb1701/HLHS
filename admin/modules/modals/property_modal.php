<!--------------------------- REMARKS-------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="remark_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Remarks</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_remark">
                <div class="modal-body">

                    <div class="md-form">
                        <input type="hidden" id="remark_id">
                        <input type="hidden" id="remark_email">
                        <label data-error="wrong" data-success="right">Remarks<span class="text-danger">*</span></label>
                        <textarea class="tinymce form-control" cols="10" rows="5" id="add_remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <div id='loader1' style='display: none;'>
                        <img src='../assets/images/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response1'></div>
                    <button type="submit" class="btn btn-primary" id="s_fee">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

<!--------------------------- REMARKS-------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_remark_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Remarks</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_update_remark">
                <div class="modal-body">

                    <div class="md-form">
                        <input type="hidden" id="edit_remark_id">
                        <label data-error="wrong" data-success="right">Remarks<span class="text-danger">*</span></label>
                        <textarea class="tinymce form-control" cols="10" rows="5" id="edit_remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>


<!------------------------------------- ACCEPT PROPERTY -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="success_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Accept?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="success_form">
                <div class="modal-body">
                    <span>are you sure do you want to accept Property Registration?</span>
                    <input type="hidden" name="" id="accept_id">
                    <input type="hidden" name="" id="accept_email">
                </div>
                <div class="modal-footer">
                    <div id='loader' style='display: none;'>
                        <img src='../assets/images/loader.gif' width="10%"><b>Sending Email, Please wait..</b>
                    </div>
                    <div class='response'></div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="e_fee">Accept</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <table class="table table-bordered" id="my_table_1">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


<!-- Document _download -->
<div class="modal fade" tabindex="-1" role="dialog" id="document_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Required Documents</h5>
                <button type="button" class="close" onclick="reFresh()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body" id="document_1">

                    <table class="table table-bordered" id="my_table_2">

                        </tbody>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>
</div>
</div>