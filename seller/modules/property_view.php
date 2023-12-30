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
                        <th class="text-center">Date Added</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Registration Status</th>
                        <th class="text-center">Details</th>
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
include "modals/modal_property.php";
?>

<script>
    //DELETE ORG
    function delete_property(property_id) {
        $('#delete_id').val(property_id);
        $('#delete_modal').modal('show');
    }

    function change_status(property_id) {
        $('#status_id').val(property_id);
        $('#status_modal').modal('show')
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
                '<th class=\"text-left font-weight-bold\">SALE TYPE</th>' +
                '<th class=\"text-center font-weight-bold\">' + res.stype + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">PRICE</th>' +
                '<th class=\"text-center p-3\">₱ ' + res.price + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">LOCATION</th>' +
                '<th class=\"text-center p-3\">' + res.loc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">NO. OF BEDROOM</th>' +
                '<th class=\"text-center p-3\">' + res.bed + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">NO. OF BATHROOM</th>' +
                '<th class=\"text-center p-3\">' + res.bath + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">NO. OF BALCONY</th>' +
                '<th class=\"text-center p-3\">' + res.balc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">NO. OF KTCHEN</th>' +
                '<th class=\"text-center p-3\">' + res.kitc + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">NO. OF HALL</th>' +
                '<th class=\"text-center p-3\">' + res.hall + '</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">AREA SIZE</th>' +
                '<th class=\"text-center p-3\">' + res.asize + ' sqrt</th>' +
                '</tr>' +
                '<tr>' +
                '<th class=\"text-left p-3\">DATE CREATED</th>' +
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


    //delete Document
    function delete_document(document_id, file_name) {

        $.ajax({
            url: 'properties/property_document_delete',
            type: 'POST',
            data: {
                document_id: document_id,
                file_name: file_name

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Removed');
                $('tr#' + document_id + '').fadeOut('slow');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    }


    //delete Images
    function delete_images(image_id, image_name) {

        $.ajax({
            url: 'properties/property_image_delete',
            type: 'POST',
            data: {
                image_id: image_id,
                image_name: image_name

            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Removed');
                $('tr#' + image_id + '').fadeOut('slow');

            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    }


    //EDIT PROPERTY
    function edit_property(property_id) {

        let table = "<thead>";
        table += "<tr>" +
            "<th class=\"text-center\">Document</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        let table1 = "<thead>";
        table1 += "<tr>" +
            "<th class=\"text-center\">Image</th>" +
            "<th class=\"text-center\">Action</th>" +
            "</tr>" +
            " </thead>" +
            " <tbody>";

        $.ajax({
            url: 'properties/property_edit',
            type: 'POST',
            data: {
                property_id: property_id
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_edit').prop("disabled", true);
            }
        }).done(function(res) {

            $.each(res.document, function(key, value) {
                table += `<tr class="text-center" id ="${value.document_id}">` +
                    `<td class="text-center"><a href="properties/upload_documents/${value.files}">${value.files}</a></td>` +
                    `<td class="text-center"><button class = "btn btn-danger"  title="Delete" onclick="delete_document(${value.document_id},'${value.files}')"><i class="bx bx-trash"></i></button></td>` +
                    '<tr>'
                $('#my_table').html(table)
            })

            $.each(res.images, function(key, value) {
                table1 += `<tr class="text-center" id ="${value.image_id}">` +
                    `<td class="text-center"><img src="properties/uploads/${value.image}" alt="pimage" height="100" width="120"></td>` +
                    `<td class="text-center"><button class = "btn btn-danger"  title="Delete" onclick="delete_images(${value.image_id},'${value.image}')"><i class="bx bx-trash"></i></button></td>` +
                    '<tr>'
                $('#my_table1').html(table1)
            })

            $("#prop_id").val(res.property_id);
            $("#title").val(res.title);
            $("#content1").text(res.content);
            $("#ptype").val(res.ptype);
            $("#stype").val(res.stype);
            $("#bath").val(res.bath);
            $("#kitc").val(res.kitc);
            $("#bed").val(res.bed);
            $("#balc").val(res.balc);
            $("#hall").val(res.hall);
            $("#price").val(res.price);
            $("#totalfl").val(res.totalfl);
            $("#asize").val(res.asize);
            $("#loc").val(res.loc);
            $("#status").val(res.status);
            $('#list_edit_modal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
            $('#list_edit_modal').modal('show');


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


         //DELETING
    $('#delete_form').submit(function(e) {
        e.preventDefault()

        let property_id = $('#delete_id').val()

        $.ajax({
            url: 'properties/property_delete',
            type: 'POST',
            data: {
                property_id: property_id

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
                $('#delete_modal').modal('hide');
            } else {
                alert(res.res_message);
            }
        }).fail(function() {
            console.log("FAIL");
        })

    })

    
        //Change Status
        $('#status_form').submit(function(e) {
            e.preventDefault()

            let property_id = $('#status_id').val()
            let status      = $('#status_change').val()

            $.ajax({
                url: 'properties/property_status',
                type: 'POST',
                data: {
                    property_id : property_id,
                    status      : status

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Updated');
                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#status_modal').modal('hide');
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log("FAIL");
            })

        })

    //DOCUMENT READY
    })



    //ADD PROPERTY
    $(document).on('submit', '#form_property', function(e) {
        e.preventDefault()
        $.ajax({
            url: 'properties/property_update',
            method: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            beforeSend: function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success Updated');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })
</script>