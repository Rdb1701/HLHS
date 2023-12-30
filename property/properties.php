<?php include "../app/database.php";
 include "includes/unseen_all_chats.php";
include "includes/property_view.php";

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
            <li class="has-children active">
              <a href="properties">Properties</a>
              <ul class="dropdown">
                <li><a href="index">Buy Property</a></li>
                <li><a href="../login">Sell Property</a></li>
              </ul>
            </li>
            <li><a href="about">About</a></li>
            <!-- <li><a href="contact.html">Contact Us</a></li> -->
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

  <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-9 text-center mt-5">
          <h1 class="heading" data-aos="fade-up">Properties</h1>

          <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb text-center justify-content-center">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active text-white-50" aria-current="page">
                Properties
              </li>
            </ol>
          </nav>

          <!-- <div class="row justify-content-center align-items-center">
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
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row mb-5 align-items-center">
        <div class="col-lg-6 text-center mx-auto">
          <h2 class="font-weight-bold text-primary heading">
            Featured Properties
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="property-slider-wrap">
            <div class="property-slider">
              <?php
              if ($property) {
                foreach ($property as $prop) {
              ?>
                  <?php
                  $query_my_image = "SELECT * FROM property_image
                  WHERE property_id = '" . $prop['property_id'] . "'
                  ";
                  $result = mysqli_query($db, $query_my_image);
                  if (mysqli_num_rows($result) > 0) {

                    $row         = mysqli_fetch_assoc($result);
                    $image_1 = $row['image'];
                  }
                  ?>

                  <div class="property-item">
                    <a href="property-single.html" class="img">
                      <img src="../owner/modules/properties/uploads/<?php echo $image_1; ?>" alt="Image" style="height: 400px;" class="img-fluid" />
                    </a>

                    <div class="property-content">
                      <div class="price mb-2"><span>₱ <?php echo number_format($prop['price']);  ?></span></div>
                      <div>
                        <span class="d-block mb-2 text-black-50"><?php echo $prop['location'];  ?></span>
                        <span class="city d-block mb-3"><?php echo ucfirst(strtolower($prop['city_name']));  ?>, <?php echo $prop['province_name'];  ?></span>

                        <div class="specs d-flex mb-4">
                          <span class="d-block d-flex align-items-center me-3">
                            <span class="icon-bed me-2"></span>
                            <span class="caption"><?php echo $prop['bedroom']; ?></span>
                          </span>
                          <span class="d-block d-flex align-items-center">
                            <span class="icon-bath me-2"></span>
                            <span class="caption"><?php echo $prop['bathroom']; ?></span>
                          </span>
                        </div>

                        <a href="property_single?prop_ID=<?php echo $prop['property_id']; ?>" class="btn btn-primary py-2 px-3">See details</a>
                      </div>
                    </div>
                  </div>
                <?php
                }
              } else {
                ?>
                <span class="btn btn-danger">Not Data Found</span>
              <?php
              }
              ?>
            </div>

            <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
              <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
              <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section section-properties">
    <div class="container">
      <div class="row">
        <?php
        if ($property) {
          foreach ($property as $prop) {
        ?>
            <?php
            $query_my_image = "SELECT * FROM property_image
                  WHERE property_id = '" . $prop['property_id'] . "'
                  ";
            $result = mysqli_query($db, $query_my_image);
            if (mysqli_num_rows($result) > 0) {

              $row         = mysqli_fetch_assoc($result);
              $image_1 = $row['image'];
            }
            ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
              <div class="property-item mb-30">
                <a href="property-single.html" class="img">
                  <img src="../owner/modules/properties/uploads/<?php echo $image_1; ?>" alt="Image" class="img-fluid" style="height: 400px;" />
                </a>

                <div class="property-content">
                  <div class="price mb-2"><span>₱ <?php echo number_format($prop['price']); ?></span></div>
                  <div>
                    <span class="d-block mb-2 text-black-50"><?php echo $prop['location']; ?></span>
                    <span class="city d-block mb-3"><?php echo ucfirst(strtolower($prop['city_name']));  ?>, <?php echo $prop['province_name'];  ?></span>

                    <div class="specs d-flex mb-4">
                      <span class="d-block d-flex align-items-center me-3">
                        <span class="icon-bed me-2"></span>
                        <span class="caption"><?php echo $prop['bedroom']; ?> beds</span>
                      </span>
                      <span class="d-block d-flex align-items-center">
                        <span class="icon-bath me-2"></span>
                        <span class="caption"><?php echo $prop['bathroom']; ?> baths</span>
                      </span>
                    </div>

                    <a href="property_single?prop_ID=<?php echo $prop['property_id']; ?>" class="btn btn-primary py-2 px-3">See details</a>
                  </div>
                </div>
              </div>
              <!-- .item -->
            </div>
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

  <?php include "../footer.php"; ?>