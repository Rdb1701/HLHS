<!------------------------------------- Change Status-------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="status_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="status_form">
                <div class="modal-body">
                    <input type="hidden" name="" id="status_id">
                    <select class="form-control" required id="status_change" name="status_change">
                        <option value="" selected hidden>Select Status</option>
                        <option value="1">Available</option>
                        <option value="0">Sold Out</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!------------------------------------- DELETE PROPERTY -------------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">
                    <span>are you sure do you want to delete?</span>
                    <input type="hidden" name="" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>

    </div>
</div>


<!-- Details Modal -->
<div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- DETAILS -->
                <table class="table table-bordered" id="my_table_1">

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>




<?php
$sql      = "SELECT province_id, name FROM provinces";
$result   = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt         = "";
$opt      .= "<select class='form-control' name='reg_province_id' id='reg_province_id' required>";
$opt      .=     "<option value = ''>Select Province</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='" . $row['province_id'] . "'>" . $row['name'] . "</option>";
}
$opt      .= "</select>";



$sql      = "SELECT property_type_id, type_name FROM property_type";
$result   = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt2         = "";
$opt2      .= "<select class='form-control' name='ptype' id='ptype' required>";
$opt2      .=     "<option value = ''>Select Property</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='" . $row['property_type_id'] . "'>" . $row['type_name'] . "</option>";
}
$opt2      .= "</select>";

?>


<div class="modal fade" tabindex="-1" role="dialog" id="list_edit_modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Edit Property</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-dark">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Property</h4>
                            </div>
                            <form id="form_property" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h5 class="card-title">Property Detail</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">Title</label>
                                                <div class="col-lg-9">
                                                    <input type="hidden" class="form-control" id="prop_id" name="prop_id">
                                                    <input type="text" class="form-control" id="title" name="title" required placeholder="Enter Title">
                                                </div><br><br>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">Content</label>
                                                <div class="col-lg-9">
                                                    <textarea class="tinymce form-control" id="content" name="content" rows="10" cols="30"></textarea>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Property Type</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" required name="ptype" id="ptype">
                                                        <option value="">Select Type</option>
                                                        <option value="1">Apartment</option>
                                                        <option value="2">Flat</option>
                                                        <option value="3">Building</option>
                                                        <option value="4">House</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Selling Type</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" required name="stype" id="stype">
                                                        <option value="">Select Status</option>
                                                        <option value="Rent">Rent</option>
                                                        <option value="Sale">Sale</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Bathroom</label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="bath" name="bath" required placeholder="Enter Bathroom (1 to 10)">
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Kitchen</label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="kitc" name="kitc" required placeholder="Enter Kitchen (1 to 10)">
                                                </div>
                                            </div>

                                        </div><br>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Bedroom</label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="bed" name="bed" required placeholder="Enter Bedroom  (1 to 10)">
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Balcony</label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="balc" name="balc" required placeholder="Enter Balcony  (to 10)">
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Hall</label>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control" id="hall" name="hall" required placeholder="Enter Hall  (to 10)">
                                                </div>
                                            </div>

                                        </div><br>
                                    </div><br><br>
                                    <h4 class="card-title">Price & Location</h4>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Price</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="price" name="price" required placeholder="Enter Price">
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Province</label>
                                                <div class="col-lg-9">
                                                    <?php echo $opt; ?>
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">City</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" id="reg_city_id" required placeholder="City" name="reg_city_id">
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Barangay</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" id="reg_barangay_id" required placeholder="Barangay" name="reg_barangay_id">
                                                        <option value=''>Select Barangay</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Total Floor</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control" required name="totalfl" id="totalfl">
                                                        <option value="">Select Floor</option>
                                                        <option value="1 Floor">1 Floor</option>
                                                        <option value="2 Floor">2 Floor</option>
                                                        <option value="3 Floor">3 Floor</option>
                                                        <option value="4 Floor">4 Floor</option>
                                                        <option value="5 Floor">5 Floor</option>
                                                        <option value="6 Floor">6 Floor</option>
                                                        <option value="7 Floor">7 Floor</option>
                                                        <option value="8 Floor">8 Floor</option>
                                                        <option value="9 Floor">9 Floor</option>
                                                        <option value="10 Floor">10 Floor</option>
                                                        <option value="11 Floor">11 Floor</option>
                                                        <option value="12 Floor">12 Floor</option>
                                                        <option value="13 Floor">13 Floor</option>
                                                        <option value="14 Floor">14 Floor</option>
                                                        <option value="15 Floor">15 Floor</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Area Size</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="asize" name="asize" required placeholder="Enter Area Size (in sqrt)">
                                                </div>
                                            </div><br>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Address</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" id="loc" name="loc" required placeholder="Enter Address">
                                                </div>
                                            </div>

                                        </div>
                                    </div><br><br>

                                    <h4 class="card-title">Required Documents ( Valid ID, Property Information, Company Registration Documents )</h4>
                                    <table class="table table-bordered" id="my_table">

                                        <!-- CONTENT -->
                                    </table>
                                    <div class="row">
                                        <div class="col-xl-12s">
                                            <div class="form-group row">
                                                <label class="d-flex">
                                                    <button type="button" id="btnDocument" class="btn btn-success btn-raised btn-sm ml-auto">
                                                        <i class="nav-icon fas fa-plus"></i>
                                                    </button>
                                                </label><br>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hovered">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-left">Files</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="newDocument">
                                                            <tr>
                                                                <td class="text-left">
                                                                    <input type="file" name="new_document[]" class="form-control">
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div><br><br>


                                            <h4 class="card-title">Property Images & Status</h4>
                                            <table class="table table-bordered" id="my_table1">

                                                <!-- CONTENT -->
                                            </table>
                                            <div class="row">
                                                <div class="col-xl-12s">
                                                    <div class="form-group row">
                                                        <label class="d-flex">
                                                            <button type="button" id="btnImage" class="btn btn-success btn-raised btn-sm ml-auto">
                                                                <i class="nav-icon fas fa-plus"></i>
                                                            </button>
                                                        </label><br>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hovered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-left">Image</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="newImage">
                                                                    <tr>
                                                                        <td class="text-left">
                                                                            <input type="file" name="new_image[]" id="" class="form-control">
                                                                        </td>
                                                                        <td class="text-center">-</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-lg-3 col-form-label">Status</label>
                                                        <div class="col-lg-9">
                                                            <select class="form-control" required id="status" name="status">
                                                                <option value="">Select Status</option>
                                                                <option value="1">Available</option>
                                                                <option value="0">Sold Out</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <input type="submit" value="Submit" class="btn btn-primary" name="add">
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    var countImage = 1;
    var countDocument = 1;

    function remove(id, type) {

        $('#' + type + id).remove()

    }

    $(document).ready(function() {
        $('#reg_province_id').on('change', function() {
            let selectedProvince = $("#reg_province_id option:selected").val();
            $.ajax({
                type: "POST",
                url: "properties/city",
                dataType: 'html',
                data: {
                    province_id: selectedProvince
                }
            }).done(function(data) {
                $('#reg_city_id').html(data);
            });
        });

        $('#reg_city_id').on('change', function() {
            let selectedCity = $("#reg_city_id option:selected").val();
            $.ajax({
                type: "POST",
                url: "properties/barangay",
                dataType: 'html',
                data: {
                    city_id: selectedCity
                }
            }).done(function(response) {
                $('#reg_barangay_id').html(response);
            });
        });

    });


    $(document).on('click', '#btnImage', function() {
        countImage++
        html = ''
        html += '<tr id="rowReport' + countImage + '">'
        html += '<td class="text-left"><input type="file" name="new_image[]" id="" class="form-control" ></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countImage + ', \'rowReport\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon bx bx-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newImage').append(html)
    })

    $(document).on('click', '#btnDocument', function() {
        countDocument++
        html = ''
        html += '<tr id="rowDocument' + countDocument + '">'
        html += '<td class="text-left"><input type="file" name="new_document[]" id="" class="form-control" ></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countDocument + ', \'rowDocument\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon bx bx-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newDocument').append(html)
    })
</script>