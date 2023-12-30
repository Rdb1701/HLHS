<!--------------------------- REMARKS-------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="percent_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Company Share</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_share">
                <div class="modal-body">
                    <div class="md-form">

                        <label data-error="wrong" data-success="right">Share Per Property<span class="text-danger">*</span></label>
                     <input type="number" class="form-control" id="share" maxlength="3.0" step="0.01"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="s_fee" onclick="submit_share()">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>