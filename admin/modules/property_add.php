<?php
include "../header.php";
?>

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

?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Property Details</h4>
            </div>
            <form id = "form_property" enctype="multipart/form-data">
                <div class="card-body">
                    <h5 class="card-title">Property Detail</h5>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Title</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="title" required placeholder="Enter Title">
                                </div><br><br>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Content</label>
                                <div class="col-lg-9">
                                    <textarea class="tinymce form-control" name="content" rows="10" cols="30"></textarea>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Property Type</label>
                                <div class="col-lg-9">
                                    <select class="form-control" required name="ptype">
                                        <option value="">Select Type</option>
                                        <option value="1">Apartment</option>
                                        <option value="2">Flat</option>
                                        <option value="3">Building</option>
                                        <option value="4">House</option>
                                        <option value="5">Villa</option>
                                        <option value="6">Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Selling Type</label>
                                <div class="col-lg-9">
                                    <select class="form-control" required name="stype">
                                        <option value="">Select Status</option>
                                        <option value="1">Rent</option>
                                        <option value="2">Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Bathroom</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="bath" required placeholder="Enter Bathroom (only no 1 to 10)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Kitchen</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="kitc" required placeholder="Enter Kitchen (only no 1 to 10)">
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Bedroom</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="bed" required placeholder="Enter Bedroom  (only no 1 to 10)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Balcony</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="balc" required placeholder="Enter Balcony  (only no 1 to 10)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Hall</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="hall" required placeholder="Enter Hall  (only no 1 to 10)">
                                </div>
                            </div>

                        </div>
                    </div><br><br>
                    <h4 class="card-title">Price & Location</h4>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Price</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="price" required placeholder="Enter Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Province</label>
                                <div class="col-lg-9">
                                    <?php echo $opt; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">City</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="reg_city_id" required placeholder="City" name="reg_city_id">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Barangay</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="reg_barangay_id" required placeholder="Barangay" name="reg_barangay_id">
                                    <option value = ''>Select Barangay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Total Floor</label>
                                <div class="col-lg-9">
                                    <select class="form-control" required name="totalfl">
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
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Area Size</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="asize" required placeholder="Enter Area Size (in sqrt)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Address</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="loc" required placeholder="Enter Address">
                                </div>
                            </div>

                        </div>
                    </div><br><br>

                    <h4 class="card-title">Image & Status</h4>
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
                                                    <input type="file" name="new_image[]" id="" class="form-control" required>
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
                                    <select class="form-control" required name="status">
                                        <option value="">Select Status</option>
                                        <option value="available">Available</option>
                                        <option value="sold out">Sold Out</option>
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

<?php
include "../footer.php";
?>


<script>

    var countImage = 1;

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
        html += '<td class="text-left"><input type="file" name="new_image[]" id="" class="form-control" required></td>'
        html += '<td class="text-center">'
        html += '<button type="button" onclick="remove(' + countImage + ', \'rowReport\')" class="btn btn-danger btn-raised btn-sm ml-2">'
        html += '<i class="nav-icon bx bx-trash"></i>'
        html += '</button>'
        html += '</td>'
        html += '</tr>'
        $('#newImage').append(html)
    })


//ADD PROPERTY
    $(document).on('submit', '#form_property', function(e) {
        e.preventDefault()
        $.ajax({
            url          : 'properties/property_add',
            method       : 'POST',
            data         : new FormData($(this)[0]),
            contentType  : false,
            processData  : false,
            cache        : false,
            dataType     : 'JSON',
            beforeSend   : function() {}
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Success');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function(err) {
            console.log(err)
        })
    })
</script>