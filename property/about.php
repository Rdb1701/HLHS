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
          <h1 class="heading active" data-aos="fade-up">About</h1>

          <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active text-white-50" aria-current="page">
                About
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row text-left mb-5">
        <div class="col-12">
          <h2 class="font-weight-bold heading text-primary mb-4">About Us</h2>
        </div>
        <div class="col-lg-6">
          <p class="text-black-50">
            Welcome to our House and Lot System, a unique and innovative platform designed to redefine the way you experience real estate. Our commitment is to provide you with a seamless and user-friendly interface that empowers you to explore, evaluate, and ultimately find the home of your dreams. Whether you are a first-time buyer, an experienced investor, or someone looking for a new place to call home, our system is tailored to cater to your specific needs.
          </p>
          <p class="text-black-50">
            At the core of our House and Lot System is a comprehensive database that showcases a diverse range of properties, from cozy townhouses to luxurious estates. We understand that every individual or family has distinct preferences, and our platform allows you to filter and search based on criteria such as location, size, and budget. With detailed property listings, high-resolution images, you can make informed decisions from the comfort of your own space.

          </p>
        </div>
        <div class="col-lg-6">
          <p class="text-black-50">
            What sets our system apart is its commitment to transparency and accuracy. We believe in providing reliable and up-to-date information about each property including legal documentations. Our goal is to ensure that you have all the information you need to make a confident and informed decision. We also offer tools and resources to connect you with experienced real estate professionals who can guide you through the buying or selling process.
          </p>
          <p class="text-black-50">
            As you navigate through our House and Lot System, you'll discover a platform that values your time and prioritizes your convenience. Whether you're browsing on a desktop computer, tablet, or smartphone, our responsive design ensures a consistent and enjoyable experience. Join us on a journey to find the perfect house and lot, where every click brings you closer to the home that aligns with your vision and lifestyle. At our core, we are not just a platform; we are your partner in realizing the dream of owning a place you can truly call your own.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="section pt-0">
    <div class="container">
      <div class="row justify-content-between mb-5">
        <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
          <div class="img-about dots">
            <div class="img-property-slide-wrap">
              <div class="img-property-slide">
                <img src="images/img_2.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_3.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_4.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_5.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_6.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_7.jpg" alt="Image" class="img-fluid" />
                <img src="images/img_8.jpg" alt="Image" class="img-fluid" />
                <img src="images/hero_bg_2.jpg" alt="Image" class="img-fluid" />
                <img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid" />
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-4">
          <div class="d-flex feature-h">
            <span class="wrap-icon me-3">
              <span class="icon-home2"></span>
            </span>
            <div class="feature-text">
              <h3 class="heading">Quality properties</h3>
              <p class="text-black-50">
                Explore a curated selection of homes, meticulously chosen for their superior construction, design, and amenities.
              </p>
            </div>
          </div>

          <div class="d-flex feature-h">
            <span class="wrap-icon me-3">
              <span class="icon-person"></span>
            </span>
            <div class="feature-text">
              <h3 class="heading">Trusted Sellers & Owners</h3>
              <p class="text-black-50">
                Rest assured with our exclusive partnerships, connecting you only with reputable sellers and owners committed to ethical practices.
              </p>
            </div>
          </div>

          <div class="d-flex feature-h">
            <span class="wrap-icon me-3">
              <span class="icon-security"></span>
            </span>
            <div class="feature-text">
              <h3 class="heading">Easy and safe</h3>
              <p class="text-black-50">
                Embark on a smooth and protected real estate adventure facilitated by our easily navigable platform.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <label for="">Send a Feedback</label>
    <textarea class="form-control" name="" id="feed" cols="30" rows="10" placeholder="Type Something..." required></textarea><br>
    <button class="btn btn-primary" id="feedback" onclick="feedback()">Submit Feedback</button>
  </div>

  <?php include "../footer.php"; ?>

<script>
  function feedback() {
    let feedback = $('#feed').val();

    if (feedback == "") {
      alert("Type Something");

    } else {
      $.ajax({
        url: 'includes/feedback_add',
        type: 'POST',
        data: {
          feedback: feedback
        },
        dataType: 'JSON',
        beforeSend: function() {
         
        }
      }).done(function(res) {
        if(res.res_success == 1){
          alert('Successfully Submit a Feedback');
          location.reload();
        }else{
          alert(res.res_message)
        }
      })
    }
  }
</script>