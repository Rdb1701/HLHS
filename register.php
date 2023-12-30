<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>House and Lot System || Log In</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="asset/css/adminlte.min.css">
      <link rel="shortcut icon" href="asset/img/house.jpg" type="image/x-icon">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <!-- /.login-logo -->
         <div class="card card-outline card-success">
            <div class="card-header text-center">
             
               <img src="asset/img/house.jpg" alt="DSMS Logo" width="200">
               <h4>House and Lot Hunt System</h4>
               <h5 class="text-danger">REGISTER OWNER</h5>
               
            </div>
            <div class="card-body" >
               <form id="form2">
               <div class="md-form">
                        <label data-error="wrong" data-success="right">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_username" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control validate" id="add_password" required>
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_name" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control validate" id="add_email" required>
                    </div>
                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="add_gender">
                            <option value="" selected hidden>- Select Gender</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div><br>
                  <div class="row">
                     <div class="col-6 offset-4">
                        <button type="submit" class="btn btn-primary" style="background-color: rgba(48,133,142);color: #fff">Register</button>
                     </div>
                  </div>
               
               </form> 
               <a href="login">Login</a>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>

     

      <!-- /.login-box -->


 <script src="admin/assets/js/jquery.min.js"></script>
   <script src="asset/js/adminlte.js"></script>
   <script src="asset/js/sweetalert.min.js"></script>
   </body>
</html>

<!-- delete USer -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to delete?</span>
                    <input type="hidden" name="" id="user_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
     $(document).ready(function(){
         // ADD USERS
         $('#form2').submit(function(e) {
            e.preventDefault();

            let username = $('#add_username').val()
            let password = $('#add_password').val()
            let name     = $('#add_name').val()
            let email    = $('#add_email').val()
            let gender   = $('#add_gender').val()
        
                $.ajax({
                    url: 'includes/register',
                    type: 'POST',
                    data: {
                        username : username,
                        name     : name,
                        password : password,
                        gender   : gender,
                        email    : email
                       
                    },

                    dataType: 'JSON',
                    beforeSend: function() {

                    }

                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Successfully Created Account');

                      window.location.href = "index";
                    } else {
                        alert(res.res_message);
                    }
                }).fail(function() {
                    console.log("FAIL!")
                })
        })
    })
</script>