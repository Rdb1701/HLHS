<!--BORROW MODAL -->
<div class="modal fade" id="service_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Request Service</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_service">
        <div class="modal-body mx-4">
        <div class="md-form">
            <label data-error="wrong" data-success="right">Service<span class="text-danger">*</span></label>
            <select class='form-control' id="add_service">
              <option value="" selected hidden>Select Service</option>
              <option value="Repair Service">Repair Service</option>
            </select>
          </div><br>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Concern</label>
            <span class="text-danger">*</span></label>
            <textarea name="" id="add_concern" cols="5" rows="5" id="add_concern" class="form-control" maxlength="255"></textarea>
          </div><br>

          <div class="text-center mt-3">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>