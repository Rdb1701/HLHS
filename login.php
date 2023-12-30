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
               <h5 class="text-danger">LOGIN</h5>
               
            </div>
            <div class="card-body" >
               <form id="form1">
               <div class="input-group mb-3">
                  <select name="" id="user_option" class="form-control">
                  <option value="" selected hidden>Login As</option>
                     <option value="1">Admin</option>
                     <option value="2">Owner</option>
					           <option value="3">Seller</option>
                  </select>
               </div>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Username" id="username">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-user"></span>
                        </div>
                     </div>
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" class="form-control" placeholder="Password" id="password">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-6 offset-4">
                        <button type="submit" class="btn btn-primary" style="background-color: rgba(48,133,142);color: #fff">Login</button>
                     </div>
                  </div>
               
               </form>

               <a href="register">Register</a>
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

<div class="modal fade" id="register_owner_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- username, lname, fname, gender, phone, user_type_id -->

            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-lable="close">&times;</button>
            </div>


            <form id="form_add">
                <div class="modal-body mx-4">

                    <input type="hidden" id="add_user_id" readonly>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_username">
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_fname">
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control validate" id="add_lname">
                    </div>

                    <div class="md-form">
                        <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
                        <select class='form-control' id="add_gender">
                            <option value="" selected hidden>- Select Gender</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>


<!------------------------------------- DELETE USER -------------------------------------------------->
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

   function register_owner(){
      $('#register_owner_modal').modal('show')
   }


 $(document).ready(function(){

//-------------------------- LOG IN -----------------------------------//

 $('#form1').submit(function(e){
   e.preventDefault();

 let username    = $('#username').val();
 let password    = $('#password').val();
 let user_option = $('#user_option').val();
 
 if(username == ""){
   alert('Please Enter Username');
 }else if (username == "" && password == ""){
   alert('Please Enter Username & Password');
 }else if(password == ""){
   alert('Please Enter Password');
 }else if(user_option == ""){
   alert('Please Enter login type');
 }else {

   $.ajax({
     url            : 'includes/login',
     type           : 'POST',
     data           : {
                     username    : username,
                     password    : password,
                     options     : user_option
                     },
     dataType       : 'JSON',
     beforeSend     : function(){

     }
   }).done(function(res){

     if(res.res_success == 1){

       if(user_option == 1){
         window.location = "admin/modules/dashboard";
       }
       if(user_option == 2){
         window.location = "owner/modules/dashboard";
       }
       if(user_option == 3){
         window.location = "seller/modules/dashboard";
       }

     }else{
       alert(res.res_message);
     }

   }).fail(function(){
       console.log('FAIL!');
   })


 }


})

 })

 </script>