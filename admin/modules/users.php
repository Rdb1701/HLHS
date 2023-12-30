<?php include "../header.php"; ?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Users</h1>
    </i>
    <div style="flex: 1;"></div>
    <button class="btn btn-md btn-success" onclick="add_user()"><i class="bx bx-user-plus"></i>Add User</button>
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Username</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                <!-- CONTENT -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include "../footer.php"; ?>
<?php include "modals/user_modal.php"; ?>

<script>
    //ADD USER
    function add_user(){
        $('#list_add_modal').modal("show");

    }

      //------------------------------CHANGE PASSWORD----------------------------------//
      function list_changepassword(user, username) {

        $('#cp_id').val(user);
        $('#cp_username').val(username);
        $('#changepassword_modal').modal('show');

        }

//EDIT USER
function edit_user(user_id) {

$.ajax({
    url: 'user/user_edit',
    type: 'POST',
    data: {
        user_id: user_id
    },
    dataType: 'JSON',
    beforeSend: function() {
        $('#btn_edit').prop("disabled", true);
    }
}).done(function(res) {

    $("#edit_gender").val(res.gender);
    $("#edit_phone").val(res.phone);
    $("#edit_user_id").val(res.user_id);
    $("#edit_username").val(res.username);
    $("#edit_active").val(res.active);
    $("#edit_name").val(res.name);
    $("#edit_type").val(res.user_type_id);
    $("#edit_email").val(res.email);
    $('#btn_edit').prop("disabled", false);
    $('#list_edit_modal').modal('show');

})
}


     $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'user/users', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                },
                {
                    data: [2],
                    "className": "text-center"
                },
                {
                    data: [3],
                    "className": "text-center"
                },
                {
                    data: [4],
                    "className": "text-center"
                },
                {
                    data: [5],
                    "className": "text-center"
                },
                {
                    data: [6],
                    "className": "text-center"
                },
                {
                    data: [7],
                    "className": "text-center"
                },
            ]
        });


        
        //-------------------------------------------- ADD USER SUMBIT ---------------------------------------//
        $('#form_insert').on('submit', function(e) {
            e.preventDefault();

            let username  = $('#add_username').val();
            let password  = $('#add_password').val();
            let name      = $('#add_name').val();
            let gender    = $('#add_gender').val();
            let email     = $('#add_email').val();
            let user_type = $('#add_type').val();
            let phone     = $('#add_phone').val();


                $.ajax({
                    url: 'user/user_add',
                    type: 'POST',
                    data: {
                        username : username,
                        password : password,
                        name     : name,
                        gender   : gender,
                        email    : email,
                        phone    : phone,
                        user_type: user_type
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Successfully Added');
                        var currentPageIndex = table.page.info().page;
                        table.ajax.reload(function() {
                            table.page(currentPageIndex).draw(false);
                        }, false);

                        $('#list_add_modal').modal('hide');
                    } else {
                        alert(res.res_message);
                    }

                }).fail(function() {
                    console.log('fail')
                })

            
        })


        //UPDATE USER
        // ---------------------UPDATE edit user----------------------------------------//

        $('#form_update').on('submit', function(e) {
            e.preventDefault();

            let user_id  = $('#edit_user_id').val();
            let username  = $('#edit_username').val();
            let name      = $('#edit_name').val();
            let gender    = $('#edit_gender').val();
            let email     = $('#edit_email').val();
            let user_type = $('#edit_type').val();
            let active    = $('#edit_active').val();
            let phone    = $('#edit_phone').val();

                $.ajax({

                    url: 'user/user_update',
                    type: 'POST',
                    data: {
                        user_id   : user_id,
                        username  : username,
                        name      : name,
                        gender    : gender,
                        email     : email,
                        phone     : phone,
                        user_type : user_type,
                        active    : active
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Update Information')
                        var currentPageIndex = table.page.info().page;
                        table.ajax.reload(function() {
                            table.page(currentPageIndex).draw(false);
                        }, false);

                        $('#list_edit_modal').modal('hide');
                    } else {
                        alert(res.res_message);
                    }
                }).fail(function() {
                    console.log('Fail!');
                });
        })


         // -----------------------CHANGE PASSWORD ----------------------------- //
         $('#d_form_cp').on('submit', function(e) {
            e.preventDefault();

            let user_id        = $('#cp_id').val();
            let new_password    = $('#cp_new_password').val()
            let re_new_password = $('#cp_re_new_password').val()

            if (new_password == '' || re_new_password == '') {
                alert('Please input Password')
            } else if (new_password != re_new_password) {
                alert('Password do not match!')

            } else if (new_password == re_new_password) {

                $.ajax({
                    url: 'user/user_changepass',
                    type: 'POST',
                    data: {
                        user_id         : user_id,
                        new_password    : new_password,
                        re_new_password : re_new_password,
                    },
                    dataType: 'JSON',
                    beforeSend: function() {

                    }
                }).done(function(res) {
                    if (res.res_success == 1) {
                        alert('Password Changed!');
                        $('#changepassword_modal').modal('hide');
                    } else {
                        alert('Invalid Password!');

                    }
                })

            }


        })
    })
</script>