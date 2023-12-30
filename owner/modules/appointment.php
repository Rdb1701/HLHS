<?php
include "../header.php";
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Appointment Visits</h1>
    </i>
    <div style="flex: 1;"></div>
    <!-- <button class="btn btn-md btn-success" onclick="add_user()"><i class="bx bx-user-plus"></i>Add User</button> -->
</h5>
<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Property Type</th>
                        <th class="text-center">Property Location</th>
                        <th class="text-center">Appointment Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- CONTENT -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include "modals/modal_appointment.php";
include "../footer.php";
?>

<script>
    // Initialize DataTable
    var table = $('#myTable').DataTable({
        ajax: 'appointments/appointment', // API endpoint to fetch data
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
            }
        ]
    });

    function delete_a(appointment_id) {
        if (confirm("Are you sure you want to remove appointment?")) {
            $.ajax({
                url: 'appointments/appointment_delete',
                type: 'POST',
                data: {
                    appointment_id: appointment_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deleted');

                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);

                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })
        }
    }

    function accept_a(appointment_id, email) {
        $('#accept_id').val(appointment_id)
        $('#accept_email').val(email)
        $('#accept_modal').modal('show');

    }


    //ACCEPTING ORGANIZATION
    $('#accept_form').submit(function(e) {
        e.preventDefault()

        let appointment_id = $('#accept_id').val()
        let email = $('#accept_email').val()

        $.ajax({
            url: 'appointments/appointment_approve',
            type: 'POST',
            data: {
                appointment_id: appointment_id,
                email: email

            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_approve').prop('disabled', true)
                // Show image container
                $("#loader").show();
            }
        }).done(function(res) {
            if (res.res_success == 1) {
                $("#loader").hide();
                alert('Successfully Accepted');
                var currentPageIndex = table.page.info().page;
                table.ajax.reload(function() {
                    table.page(currentPageIndex).draw(false);
                }, false);
                $('#accept_modal').modal('hide');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    })
</script>