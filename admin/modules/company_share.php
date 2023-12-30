<?php
include "../header.php";
?>
<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Company Share</h1>
    </i>
    <div style="flex: 1;"></div>
    <button class="btn btn-md btn-success" onclick="add_share()"><i class="fa fa-percent"></i> Share Percentage</button>
</h5>


<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Type</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Owner</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Company Share</th>
                        <th class="text-center">Total Share</th>
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
include "modals/modal_share.php";
include "../footer.php";
?>

<script>
    function add_share() {
        $('#percent_modal').modal('show')
    }

    function submit_share() {
        let share = $('#share').val()

        if (share > 100) {
            alert("You exceeds the maximum of 100%");
        } else {
            $.ajax({
                url: 'share/share_add',
                type: 'POST',
                data: {
                    share: share
                
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Added a Share');
                    location.reload()
                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })
        }
    }

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'share/share_view', // API endpoint to fetch data
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
            ],
            dom: "Bfrtip",
            buttons: [{
                    extend: "pageLength",
                    className: "btn-sm btn-primary"
                },
                {
                    extend: "csv",
                    className: "btn-sm btn-primary",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5]
                    }
                },
                {
                    extend: "excel",
                    className: "btn-sm btn-primary",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5]
                    }
                },
                {
                    extend: "print",
                    className: "btn-sm btn-primary",
                    title: '.',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5]
                    },
                    message: '<img src="../assets/images/favicon.jpg" height="100px" width="100px" style="position: absolute;top:0;left:50px;"><center><h4 style="margin-top:-40px;">HOUSE AND LOT HUNT SYSTEM</h4>\
							</center><br>\
              <center>LIST OF PROPERTIES</center><br>',
                }


            ]
        });

    })
</script>