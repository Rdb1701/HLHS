<?php include "../app/database.php";
include "includes/unseen_all_chats.php";
$property_id =  mysqli_real_escape_string($db, $_GET['prop_ID']);
include "includes/property_single_view.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.png" />
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>
        House and Lot System
    </title>
    <style>
        * {
            margin: 0;
        }

        #map {
            height: 500px;
            width: 100%;
        }

        .chat_message_area {
            position: relative;
            width: 100%;
            height: auto;
            background-color: #FFF;
            border: 1px solid #CCC;
            border-radius: 3px;
        }

        #group_chat_message {
            width: 100%;
            height: auto;
            min-height: 80px;
            overflow: auto;
            padding: 6px 24px 6px 12px;
        }
    </style>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="index" class="logo m-0 float-start">Property</a>
                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li><a href="index">Home</a></li>
                        <li class="has-children">
                            <a href="properties">Properties</a>
                            <ul class="dropdown">
                                <li><a href="index">Buy Property</a></li>
                                <li><a href="../login">Sell Property</a></li>
                            </ul>
                        </li>
                        <li><a href="about">About</a></li>
                        <!-- <li><a href="contact">Contact Us</a></li> -->
                        <?php
                        if (isset($_SESSION['customer'])) {

                        ?>
                            <li class="has-children">
                                <a href="#">Chats <?php echo count_all_unseen_message($_SESSION['customer']['user_id'], $db); ?></a>
                                <ul class="dropdown">
                                    <li><a href="owner_chat">Owner</a></li>
                                    <li><a href="seller_chat">Seller</a></li>
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="#">My Account</a>
                                <ul class="dropdown">
                                <li><a href="properties_appointment">Appointments</a></li>
                                    <li><a href="#" onclick="edit_customer(<?php echo $_SESSION['customer']['user_id']; ?>)">Profile</a></li>
                                    <li><a href="../includes/logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a href="#" onclick="register_cus()">Register</a></li>
                            <li><a href="#" onclick="login_cus()">Login</a></li>

                        <?php } ?>
                    </ul>

                    <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_3.jpg')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">
                        <?php echo $location; ?>
                    </h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="properties">Properties</a>
                            </li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                <?php echo $location; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="img-property-slide-wrap">
                        <div class="img-property-slide">
                            <?php
                            if ($property_image) {
                                foreach ($property_image as $image) {
                            ?>
                                    <img src="../owner/modules/properties/uploads/<?php echo $image['image']; ?>" alt="Image" class="img-fluid" />
                                <?php
                                }
                            } else {
                                ?>
                                <span class="btn btn-danger">Not Data Found</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="heading text-primary"><?php echo $location; ?></h2>
                    <p class="meta"><?php echo $province_name; ?>, <?php echo $city_name; ?></p>
                    <p class="text-black-50">
                        <?php echo $content; ?>
                    </p>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Property Type</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $type_name; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Location</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo ucfirst(strtolower($city_name)); ?>, <?php echo $province_name; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Price</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    ₱ <?php echo $price; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. Of Beds</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $bedroom; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. of Balcony</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $balcony; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No. of Kitchen</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $kitchen; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Size</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $size; ?> sqm
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-block agent-box p-5">
                        <!-- <div class="img mb-4">
                            <img src="images/person_2-min.jpg" alt="Image" class="img-fluid" />
                        </div> -->
                        <div class="text">
                            <h3 class="mb-0"><?php echo $u_name; ?></h3>
                            <div class="meta mb-3">Owner</div>
                            <ul class="list-unstyled social dark-hover d-flex">
                                <li class="me-1">
                                    <button class="btn btn-success" onclick="show_map()"><i class="fa fa-map-marker-alt"></i> Map</button>
                                </li>
                                <?php
                                if (isset($_SESSION['customer'])) {
                                ?>
                                    <li class="me-1">
                                        <button class="btn btn-success" onclick="chat_now(<?php echo $user_id; ?>)"><i class="fa fa-comment"></i> Chat</button>
                                    </li>
                                    <li class="me-1">
                                        <button class="btn btn-success" title="Set Appointment" onclick="appointment(<?php echo $property_id; ?>)"><i class="fa fa-calendar"></i> </button>
                                    </li>
                                <?php } else { ?>
                                    <li class="me-1">
                                        <button class="btn btn-success" onclick="not_login()"><i class="fa fa-comment"></i> Chat</button>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-widget col-md-6">
                <h4 class="double-down-line-left text-secondary position-relative pb-4 my-4">Mortgage Calculator</h4>
                <label class="sr-only">Property Amount</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-money-bill"></i></div>
                    </div>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Property Price" required>
                </div>
                <label class="sr-only">Month</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <input type="text" class="form-control" id="month" name="month" placeholder="Year Duration" required>
                </div>
                <label class="sr-only">Interest Rate</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="interest" name="interest" placeholder="Interest Rate" required>
                </div>
                <button type="button" value="submit" onclick="mort_cal()" class="btn btn-success mt-4">Calculate</button>
            </div>
        </div>

    </div>



    <!----------------------------------------------- MODAL -------------------------------------------------->
    <!-- Modal -->
    <div class="modal fade" id="map_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Map Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------------- MODAL CHAT-------------------------------------------------->
    <!-- Modal -->
    <div class="modal fade" id="chat_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="chat"></div>
                    <h5 class="text-center text-dark">Owner</h5>
                    <table class="table" id="owner_table">

                    </table>
                    <hr>

                    <h5 class="text-center text-dark">Sellers</h5>
                    <table class="table" id="seller_table">
                        <thead>
                            <tr>
                                <td class="text-center">Name</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <!----------------------------------------------- MODAL -------------------------------------------------->
    <!-- Show mortgage Modal -->
    <div class="modal fade" id="mortgage_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mortgage Calculator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" id="mortgage">

                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <!----------------------------------------------- MODAL -------------------------------------------------->
    <!-- Show CHAT Modal -->
    <div class="modal fade" id="chat2_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CHAT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal_user">

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!----------------------------------------------- MODAL -------------------------------------------------->
    <!-- Show CHAT Modal -->
    <div class="modal fade" id="appointment_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment Visit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_appointment">
                    <div class="modal-body">
                        <label for="">Prefered Appointment Date</label>
                        <input type="hidden" id = "prop_id">
                        <input type="date" name="" id="appointment_date" class="form-control" required>
                        <label for="">Prefered Time</label>
                        <input type="time" id="appointment_time" class="form-control" required>
                        <label for="">Message</label>
                        <textarea name="" id="message" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="container">
                <div class="table-responsive">

                    <div id="user_details"></div>
                    <div id="user_model_details"></div>
                </div>
            </div> -->
    <?php include "../footer.php";  ?>
    <script src="js/functions.js"></script>

    <script>
        function appointment(property_id) {
            $('#prop_id').val(property_id)
            $('#appointment_modal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
            $('#appointment_modal').modal('show')
        }

        $(document).ready(function() {
            setInterval(function() {

                update_chat_history_data();

            }, 5000);
        })
        //if not login customer
        function not_login() {
            alert("Please Login / Register First")
        }

        //chat now button
        function chat_now(user_id) {
            let table1 = "<thead>";
            table1 += "<tr>" +
                "<th class=\"text-center\">Name</th>" +
                "<th class=\"text-center\">Action</th>" +
                "</tr>" +
                " </thead>" +
                " <tbody>";

            let table = "<thead>";
            table += "<tr>" +
                "<th class=\"text-center\">Name</th>" +
                "<th class=\"text-center\">Action</th>" +
                "</tr>" +
                " </thead>" +
                " <tbody>";

            $.ajax({
                url: 'includes/chat_user_view',
                type: 'POST',
                data: {
                    user_id: user_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    table1 += '<tr>' +
                        '<td class="text-center">' + res.owner_name + '</td>' +
                        '<td class="text-center"><button class="btn btn-success" onclick ="chat(' + res.owner_id + ',' + `'${res.owner_name}', '<?php echo $type_name; ?>', '<?php echo $location; ?>', <?php echo $property_id; ?> )">Chat</button></td>'` +
                        '<tr>'

                    $.each(res.data1, function(key, value) {
                        table += '<tr>' +
                            '<td class="text-center">' + value.u_name + '</td>' +
                            '<td class="text-center"><button class="btn btn-success" onclick ="chat(' + value.seller_id + ', ' + `'${value.u_name}', '<?php echo $type_name; ?>', '<?php echo $location; ?>', <?php echo $property_id; ?> )">Chat</button></td>'` +
                            '<tr>'
                        $('#seller_table').html(table)
                    })

                    $('#owner_table').html(table1)
                } else {}
                $('#chat_modal').modal('show')
            })
        }

        //mortgage calculator
        function mort_cal() {

            let amount = $('#amount').val()
            let month = $('#month').val()
            let interest = $('#interest').val()
            $.ajax({
                url: 'includes/calculate_mortgage',
                type: 'POST',
                data: {
                    amount: amount,
                    month: month,
                    interest: interest
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                let data = `<thead>
                            <tr class="bg-secondary">
                                <th class="text-white font-weight-bolder text-center">Term</th>
                                <th class="text-white font-weight-bolder text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center font-18">
                                <td><b>Amount</b></td>
                                <td><b>₱ ${amount}</b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Duration</b></td>
                                <td id=""><b>${month} Months</b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Interest Rate</b></td>
                                <td><b>${interest} %</b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Interest</b></td>
                                <td><b>₱ ${res.interest}</b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Total Amount</b></td>
                                <td><b>₱ ${res.pay}</b></td>
                            </tr>
                            <tr class="text-center">
                                <td><b>Monthly Payment</b></td>
                                <td><b>₱ ${res.month}</b></td>
                            </tr>
                        </tbody>`;

                $('#mortgage').html(data)
                $('#mortgage_modal').modal('show')
            })
        }


        //google map show
        function show_map() {

            $('#map_modal').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
            $('#map_modal').modal('show')

        }

        function initMap() {
            // Initialize the Geocoder object
            var geocoder = new google.maps.Geocoder();

            // Define the place you want to convert
            var address = "<?php echo $location; ?> ";

            // Make the geocoding request
            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    // Get the latitude and longitude
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();

                    // Use the obtained coordinates for the map
                    var location = {
                        lat: lat,
                        lng: lng
                    };

                    // Create the map
                    var map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: location
                    });

                    // Place a marker on the map
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                } else {
                    console.error("Geocoding failed:", status);
                }
            });
        }
    </script>

    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4XcET7iAKYphr-Z6_39eaRBzRg1u7NY&callback=initMap"></script> -->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                