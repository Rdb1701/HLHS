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

  <link rel="stylesheet" href="fonts/icomoon/style.css" />
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

  <link rel="stylesheet" href="css/tiny-slider.css" />
  <link rel="stylesheet" href="css/aos.css" />
  <link rel="stylesheet" href="css/style.css" />


  <title>
    House and Lot System
  </title>
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
          <a href="index.html" class="logo m-0 float-start">Property</a>

          <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
            <li class="active"><a href="index">Home</a></li>
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


  <div class="hero">
    <div class="hero-slide">
      <div class="img overlay" style="background-image: url('images/hero_bg_3.jpg')"></div>
      <div class="img overlay" style="background-image: url('images/hero_bg_2.jpg')"></div>
      <div class="img overlay" style="background-image: url('images/hero_bg_1.jpg')"></div>
    </div>

    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-9 text-center">
          <h1 class="heading" data-aos="fade-up">
            Easiest way to find your dream home
          </h1>
          <form class=" form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" id="search_bar" class="form-control px-4" placeholder="Enter Province or Zipcode" />
            <button type="button" onclick="only_search()" class="btn btn-primary">Search</button>&nbsp;&nbsp;
            <button type="button" onclick="filter_search()" class="btn btn-primary">Filter</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row mb-5 align-items-center">
        <div class="col-lg-6" id="pop_property">
          <h2 class="font-weight-bold text-primary heading">
            Popular Properties
          </h2>
        </div>
        <!-- <div class="col-lg-6 text-lg-end">
          <p>
            <a href="property_all" target="_blank" class="btn btn-primary text-white py-3 px-4">View all properties</a>
          </p>
        </div> -->
      </div>