<?php include "../app/database.php";
include "includes/unseen_all_chats.php";
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
                        Owner Chats
                    </h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item">
                                <a href="#">Chats</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container card radius-10">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="myTable">
                    <thead class="table">
                        <tr>
                            <th class="text-center">Owner Name</th>
                            <th class="text-center">Property Type</th>
                            <th class="text-center">Property Location</th>
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

    <?php
    include "../footer.php";
    ?>

    <script src="../owner/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../owner/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../owner/assets/vendor/datatables/datatables-demo.js"></script>
    <!-- functions -->
    <script src="js/functions.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myTable').DataTable({
                ajax: 'chat/chats', // API endpoint to fetch data
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
                ]
            });
        })

        $(document).ready(function() {
            setInterval(function() {

                update_chat_history_data();

            }, 5000);
        })
    </script>