<?php
include "../header.php";
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Shares - Sold Properties</h1>
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
                        <th class="text-center">Type</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Date Added</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Share</th>
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
include "../footer.php";
?>

<script>
        $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'share/shares', // API endpoint to fetch data
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
              <center>PROPERTY SHARES</center><br>',
                }
            ]
        });

    })

</script>