<?php
include "../header.php";
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Property</h1>
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
                        <th class="text-center">Title</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Registration Status</th>
                        <th class="text-center"> Documents / Details</th>
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
include "../footer.php";
include "modals/property_modal.php";
?>

<script>
    function reFresh() {
        location.reload();
    }

    function reject_property(property_id,email) {
        $('#remark_email').val(email)
        $('#remark_id').val(property_id)
        $('#remark_modal').modal('show')
    }

    //-----------------------------------------------------REMARKS EDIT---------------------------------------------------------->
    function edit_remark(property_id) {
        $('#edit_remark_id').val(property_id)
        $('#edit_remark_modal').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $('#edit_remark_modal').modal('show');


    }

    function accept_property(property_id,email) {
        $('#accept_id').val(property_id)
        $('#accept_email').val(email)
        $('#success_modal').modal('show')
    }

    function file_documents(property_id) {

        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Document</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'properties/property_documents',
            type: 'POST',
            data: {
                property_id: property_id
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_edit').prop("disabled", true);
            }
        }).done(function(res) {

            if (res.document.length !== 0) {
                $.each(res.document, function(key, value) {
                    table += '<tr>' +
                        '<td class="text-center">' + value.files + '</td>' +
                        '<td class="text-center"> <a href="../../owner/modules/properties/upload_documents/' + value.files + '" class="btn btn-primary"><i class="fa fa-download"></i>Download</a></td>' +
                        '<tr>'
                    $('#my_table_2').html(table)
                })
            } else {
                table += `<tr class="text-center">
                            <td class="text-center text-danger" colspan="2">No Document Found</td>
                        </tr>`
                $('#my_table_2').html(table)
            }
            $('#document_modal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $('#document_modal').modal('show');
        })
    }


    function view_details(property_id) {

        $.ajax({
            url: 'properties/property_details',
            type: 'POST',
            data: {
                property_id: property_id

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {

            let table = "<thead>";
            table += "<tr>" +
                '<th class=\"text-left font-weight-bold text-danger p-3\">OWNER</th>' +
                '<th class=\"text-center font-weight-bold p-3\">' + res.name + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">SALE TYPE</th>' +
                '<th class=\"text-center p-3\">' + res.stype + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">PRICE</th>' +
                '<th class=\"text-center p-3\">₱ ' + res.price + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">LOCATION</th>' +
                '<th class=\"text-center p-3\">' + res.loc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">NO. OF BEDROOM</th>' +
                '<th class=\"text-center p-3\">' + res.bed + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">NO. OF BATHROOM</th>' +
                '<th class=\"text-center p-3\">' + res.bath + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">NO. OF BALCONY</th>' +
                '<th class=\"text-center p-3\">' + res.balc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">NO. OF KTCHEN</th>' +
                '<th class=\"text-center p-3\">' + res.kitc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">NO. OF HALL</th>' +
                '<th class=\"text-center p-3\">' + res.hall + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">AREA SIZE</th>' +
                '<th class=\"text-center p-3\">' + res.asize + ' sqm</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left text-danger p-3\">DATE CREATED</th>' +
                '<th class=\"text-center p-3\">' + res.date_inserted + '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            $('#my_table_1').html(table)
            $('#show_modal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $('#show_modal').modal('show');

        }).fail(function() {
            console.log("FAIL");
        })
    }



    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'properties/property_view', // API endpoint to fetch data
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
                }
            ]
        });

        //ACCEPT
        $('#success_form').submit(function(e) {
            e.preventDefault()

            let property_id = $('#accept_id').val()
            let email       = $('#accept_email').val()

            $.ajax({
                url: 'properties/property_accept',
                type: 'POST',
                data: {
                    property_id : property_id,
                    email       : email

                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#s_fee').prop('disabled', true)
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
                    $('#success_modal').modal('hide');
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })

        })


        //REMARKS
        $('#form_remark').submit(function(e) {
            e.preventDefault()

            let property_id = $('#remark_id').val()
            let email       = $('#remark_email').val()
            let remarks     = $('#add_remark').val()

            $.ajax({
                url: 'properties/property_reject',
                type: 'POST',
                data: {
                    property_id : property_id,
                    remarks     : remarks,
                    email       : email
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $('#s_fee').prop('disabled', true)
                // Show image container
                $("#loader1").show();
                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    $("#loader1").hide();
                    alert('Successfully Rejected');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#remark_modal').modal('hide');
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })
        })

          //REMARKS
          $('#form_update_remark').submit(function(e) {
            e.preventDefault()

            let property_id = $('#edit_remark_id').val()
            let remarks = $('#edit_remark').val()

            $.ajax({
                url: 'properties/property_remark_update',
                type: 'POST',
                data: {
                    property_id: property_id,
                    remarks: remarks
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Rejected');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#edit_remark_modal').modal('hide');
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })
        })
    })
</script>