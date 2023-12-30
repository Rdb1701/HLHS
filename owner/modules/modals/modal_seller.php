
<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add Seller</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_insert">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_username" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Password <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_password" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_name" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="add_gender" required>
              <option value="" selected hidden>Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="add_email" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="add_phone" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Commission per sale</label>
            <input type="number" class="form-control validate" id="add_sale" required>
          </div>
          </div>
          <div class="modal-footer text-center mt-3">
            <button type="submit" class="btn btn-success btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>



<!-------------------------------------- EDIT USER ---------------------------------->
<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit User</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_update">
        <div class="modal-body mx-4">
          <div class="md-form">
          <input type="hidden" class="form-control validate" id="edit_user_id" required disabled>
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_username" required disabled>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_name" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_gender" required>
              <option value="" selected hidden>Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="edit_email" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="edit_phone" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Commission per sale</label>
            <input type="number" class="form-control validate" id="edit_sale" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Active <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_active" required>
              <option value="" selected hidden>Select</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          
          </div>
          <div class="modal-footer text-center mt-3">
            <button type="submit" class="btn btn-success btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!-------------------------------------------- Change Password modal ------------------------------------------------->
<div class="modal fade" id="changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>

            <input type="text" class="form-control validate" id="cp_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_new_password" required>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_re_new_password" required>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name="signupbtn">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>