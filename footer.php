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

<!-- MODAL -->
<div class="modal fade" id="searchModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Search Property</h3>
        <button type="button" class="close d_cancel" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <div class="modal-body mx-4">

        <div class="mb-4" style="overflow-y: auto;">
          <table class="table">
            <thead>
              <tr>
                <th style="white-space: nowrap;" class="text-start">Property Type</th>
                <th style="white-space: nowrap;" class="text-start">Province</th>
                <th style="white-space: nowrap;" class="text-start">City</th>
                <th style="white-space: nowrap;" class="text-center">Barangay</th>
                <th style="white-space: nowrap;" class="text-center">Prices</th>
                <th style="white-space: nowrap;" class="text-center">Action</th>
              </tr>
              <tr>
                <th class="text-start">
                  <?php echo $opt2; ?>
                </th>
                <th class="text-start">
                  <?php echo $opt; ?>
                </th>
                <th class="text-center">
                  <select class="form-control" id="reg_city_id" required placeholder="City" name="reg_city_id">
                    <option value="">Select City</option>
                  </select>
                </th>
                <th class="text-center">
                  <select class="form-control" id="reg_barangay_id" required placeholder="Barangay" name="reg_barangay_id">
                    <option value=''>Select Barangay</option>
                  </select>
                </th>
                <th class="text-center">
                  <select class="form-control" id="prices" required placeholder="Barangay" name="prices">
                    <option value=''>Select Price Range</option>
                    <option value='1'>₱ 100,000 - ₱ 500,000</option>
                    <option value='2'>₱ 500,000 - ₱ 1,000,000</option>
                    <option value='3'>₱ 1,000,000 - ₱ 5,000,000</option>
                    <option value='4'>₱ 5,000,000 and above</option>
                  </select>
                </th>
                <th class="text-center">
                  <button class="btn btn-primary btn-raised btn-sm" onclick="get_search()">SEARCH</button>
                </th>
              </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Register Costumer Modal -->
<div class="modal fade" id="list_reg_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Register Customer</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_reg_customer">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="cadd_username" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cadd_password" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="cadd_name" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="cadd_gender" required>
              <option value="" selected hidden>Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="cadd_email" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="cadd_phone" required>
          </div>
        </div>
        <div class="modal-footer text-center mt-3">
          <button type="submit" class="btn btn-success btn-block z-depth-1a">SUBMIT</button>
        </div>

    </div>
    </form>

  </div>
</div>
</div>

<!-- Edit Costumer Modal -->
<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit Profile</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_udpate_customer">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="hidden" id="edit_user_id" >
            <input type="text" class="form-control validate" id="edit_username" required disabled>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">New Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="edit_password" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_name" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_gender" required>
              <option value="" selected hidden>Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Email</label>
            <input type="email" class="form-control validate" id="edit_email" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="edit_phone" required>
          </div>
        </div>
        <div class="modal-footer text-center mt-3">
          <button type="submit" class="btn btn-success btn-block z-depth-1a" >SUBMIT</button>
        </div>

    </div>
    </form>

  </div>
</div>
</div>


<div class="modal fade" id="list_login_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Login</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_login_customer">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="c_username" required>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="c_password" required>
          </div>
        </div>
        <div class="modal-footer text-center mt-3">
          <button type="submit" class="btn btn-success btn-block z-depth-1a">LOGIN</button>
        </div>
    </div>
    </form>

  </div>
</div>
</div>


<div class="row mt-5">
  <div class="col-12 text-center">
  <p class="mb-0">House and Lot Hunt System &copy; 2023</p>
  </div>
</div>
</div>
<!-- /.container -->
</div>
<!-- /.site-footer -->

<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/aos.js"></script>
<script src="js/navbar.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>
<script src="../owner/assets/js/jquery.min.js"></script>
<script src="../owner/assets/js/jquery-ui.min.js"></script>
<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
</body>

</html>



<script>
  function login_cus() {
    $('#list_login_modal').modal('show');
  }
  //registration
  function register_cus() {
    $('#list_reg_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#list_reg_modal').modal('show')
  }

  function filter_search() {
    $('#searchModal').modal({
      backdrop: 'static',
      keyboard: false
    })
    $('#searchModal').modal('show')
  }

  //EDIT USER
  function edit_customer(costumer_id) {

    $.ajax({
      url: '../includes/customer_edit',
      type: 'POST',
      data: {
        costumer_id: costumer_id
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
      $("#edit_name").val(res.name);
      $("#edit_email").val(res.email);
      $('#btn_edit').prop("disabled", false);
      $('#list_edit_modal').modal({
      backdrop: 'static',
      keyboard: false
    })
      $('#list_edit_modal').modal('show');

    })
  }

  //SEARCH FILTER
  function get_search() {
    $.ajax({
      url: 'includes/property_search',
      type: 'POST',
      data: {
        province: $('#reg_province_id').val(),
        city: $('#reg_city_id').val(),
        barangay: $('#reg_barangay_id').val(),
        property_type: $('#ptype').val(),
        prices: $('#prices').val()
      },
      dataType: 'JSON',
      beforeSend: function() {
        $('#views_property').html('<tr><td class="text-center" colspan="4">Loading Records...</td></tr>');
      }
    }).done(function(res) {

      if (res.searches.length > 0) {
        $('#pop_property').html('<h2 class="font-weight-bold text-primary heading">Properties Found </h2>')
        $('#views_property').html("")

        $.each(res.searches, function(key, value) {
          let property_id = value.property_id;
          let image_1 = "";

          $.ajax({
            url: 'includes/get_image', // Replace with the actual path to your PHP script
            type: 'POST',
            data: {
              property_id: property_id
            },
            dataType: 'JSON',
          }).done(function(res) {

            let data = '<div class="col-md-4 col-lg-4 col-sm-12">' +
              '<div class="property-item">';

            $.each(res.property_image, function(key, value) {
              data += '<a href="property-single" class="img">' +
                '<img src="../owner/modules/properties/uploads/' + value.image + '" alt="Image" style="height: 400px;" class="img-fluid" />' +
                '</a>';

            })

            data += '<div class="property-content">' +
              '<div class="price mb-2"><span>₱ ' + value.price + '</span></div>' +
              '<div>' +
              '<span class="d-block mb-2 text-black-50">' + value.location + '</span>' +
              '<span class="city d-block mb-3">' + value.province_name + ", " + value.city_name + '</span>' +
              '<div class="specs d-flex mb-4">' +
              '<span class="d-block d-flex align-items-center me-3">' +
              '<span class="icon-bed me-2"></span>' +
              '<span class="caption">' + value.bedroom + '</span>' +
              '</span>' +
              '<span class="d-block d-flex align-items-center">' +
              '<span class="icon-bath me-2"></span>'
            '<span class="caption">' + value.bathroom + '</span>';


            data += '</span>' +
              '</div>' +
              '<a href="property_single?prop_ID=' + value.property_id + '" class="btn btn-primary py-2 px-3">See details</a>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>';
            $('#views_property').append(data)
          });

        })

      } else {
        let data = '<h2 class="text-danger">No Properties Found</h2>';
        $('#pop_property').hide();
        $('#views_property').html(data)
      }

      $('#slider_1').html("");
      $('#searchModal').modal('hide')

    });
  }


  //SEARCH BAR
  function only_search() {

    if ($('#search_bar').val() == '') {
      alert("Please Input Search")
    } else {
      $.ajax({
        url: 'includes/search_bar',
        type: 'POST',
        data: {
          search: $('#search_bar').val(),
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.searches.length > 0) {
          $('#pop_property').html('<h2 class="font-weight-bold text-primary heading">Properties Found </h2>')
          $('#views_property').html("")

          $.each(res.searches, function(key, value) {
            let property_id = value.property_id;
            let image_1 = "";

            $.ajax({
              url: 'includes/get_image', // Replace with the actual path to your PHP script
              type: 'POST',
              data: {
                property_id: property_id
              },
              dataType: 'JSON',
            }).done(function(res) {

              let data = '<div class="col-md-4 col-lg-4 col-sm-12">' +
                '<div class="property-item">';

              $.each(res.property_image, function(key, value) {
                data += '<a href="property-single" class="img">' +
                  '<img src="../owner/modules/properties/uploads/' + value.image + '" alt="Image" style="height: 400px;" class="img-fluid" />' +
                  '</a>';

              })

              data += '<div class="property-content">' +
                '<div class="price mb-2"><span>₱ ' + value.price.toLocaleString() + '</span></div>' +
                '<div>' +
                '<span class="d-block mb-2 text-black-50">' + value.location + '</span>' +
                '<span class="city d-block mb-3">' + value.province_name + ", " + value.city_name + '</span>' +
                '<div class="specs d-flex mb-4">' +
                '<span class="d-block d-flex align-items-center me-3">' +
                '<span class="icon-bed me-2"></span>' +
                '<span class="caption">' + value.bedroom + '</span>' +
                '</span>' +
                '<span class="d-block d-flex align-items-center">' +
                '<span class="icon-bath me-2"></span>'
              '<span class="caption">' + value.bathroom + '</span>';


              data += '</span>' +
                '</div>' +
                '<a href="property_single?prop_ID=' + value.property_id + '" class="btn btn-primary py-2 px-3">See details</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';


              $('#views_property').append(data)
            });

          })

        } else {
          let data = '<h2 class="text-danger">No Properties Found</h2>';
          $('#pop_property').hide();
          $('#views_property').html(data)
        }

        $('#slider_1').html("");
        $('#searchModal').modal('hide')
      })
    }
  }

  $(document).ready(function() {




    //-------------------------------------------- ADD USER SUMBIT ---------------------------------------//
    $('#form_reg_customer').on('submit', function(e) {
      e.preventDefault();

      let username = $('#cadd_username').val();
      let password = $('#cadd_password').val();
      let name = $('#cadd_name').val();
      let gender = $('#cadd_gender').val();
      let email = $('#cadd_email').val();
      let phone = $('#cadd_phone').val();


      $.ajax({
        url: '../includes/register_customer',
        type: 'POST',
        data: {
          username: username,
          password: password,
          name: name,
          gender: gender,
          email: email,
          phone: phone
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          $('#list_reg_modal').modal('hide');
          alert('Successfully Registered');

          $('#list_login_modal').modal({
            backdrop: 'static',
            keyboard: false
          })
          $('#list_login_modal').modal('show');
        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })
    })


       //-------------------------------------------- UPDATE SUMBIT ---------------------------------------//
       $('#form_udpate_customer').on('submit', function(e) {
      e.preventDefault();

      let username = $('#edit_username').val();
      let password = $('#edit_password').val();
      let name     = $('#edit_name').val();
      let gender   = $('#edit_gender').val();
      let email    = $('#edit_email').val();
      let phone    = $('#edit_phone').val();
      let user_id  = $('#edit_user_id').val();

      $.ajax({
        url: 'includes/customer_update',
        type: 'POST',
        data: {
          username: username,
          password: password,
          name    : name,
          gender  : gender,
          email   : email,
          phone   : phone,
          user_id : user_id
        },
        dataType: 'JSON',
        beforeSend: function() {

        }
      }).done(function(res) {
        if (res.res_success == 1) {
          $('#list_edit_modal').modal('hide');
          alert('Successfully Updated');
        } else {
          alert(res.res_message);
        }

      }).fail(function() {
        console.log('fail')
      })
    })

    //LOGIN COSTUMER
    //-------------------------- LOG IN -----------------------------------//

    $('#form_login_customer').submit(function(e) {
      e.preventDefault();

      let username = $('#c_username').val();
      let password = $('#c_password').val();

      if (username == "") {
        alert('Please Enter Username');
      } else if (username == "" && password == "") {
        alert('Please Enter Username & Password');
      } else if (password == "") {
        alert('Please Enter Password');
      } else {

        $.ajax({
          url: '../includes/login_customer',
          type: 'POST',
          data: {
            username: username,
            password: password,
          },
          dataType: 'JSON',
          beforeSend: function() {

          }
        }).done(function(res) {

          if (res.res_success == 1) {

            window.location = "index";

          } else {
            alert(res.res_message);
          }

        }).fail(function() {
          console.log('FAIL!');
        })


      }

    })


    $('#reg_province_id').on('change', function() {
      let selectedProvince = $("#reg_province_id option:selected").val();
      $.ajax({
        type: "POST",
        url: "../owner/modules/properties/city",
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
        url: "../owner/modules/properties/barangay",
        dataType: 'html',
        data: {
          city_id: selectedCity
        }
      }).done(function(response) {
        $('#reg_barangay_id').html(response);
      });
    });

  });
</script>