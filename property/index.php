<?php 
include "../header.php";
include "includes/property_view.php"; 
$image_image = "";
?>

        <div class="row" id = "slider_1">
          <div class="col-12">
            <div class="property-slider-wrap">
              <div class="property-slider">

              <?php
                    if ($property) {
                        foreach ($property as $prop) {
                    ?>
                  <?php 
                  $query_my_image = "SELECT * FROM property_image
                  WHERE property_id = '".$prop['property_id']."'
                  ";
                  $result = mysqli_query($db, $query_my_image);
                if (mysqli_num_rows($result) > 0) {

                  $row         = mysqli_fetch_assoc($result);
                  $image_1 = $row['image'];
                }
                  ?>

                <div class="property-item">
                  <a href="property-single.html" class="img">
                    <img src="../owner/modules/properties/uploads/<?php echo $image_1; ?>" alt="Image" style= "height: 400px;" class="img-fluid" />
                  </a>

                  <div class="property-content">
                    <div class="price mb-2"><span>₱ <?php echo number_format($prop['price']);  ?></span></div>
                    <div>
                      <span class="d-block mb-2 text-black-50"
                        ><?php echo $prop['location'];  ?></span
                      >
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

                      <a
                        href="property_single?prop_ID=<?php echo $prop['property_id'];?>"
                        class="btn btn-primary py-2 px-3"
                        >See details</a
                      >
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

                <!-- .item -->
              </div>

              <div
                id="property-nav"
                class="controls"
                tabindex="0"
                aria-label="Carousel Navigation"
              >
                <span
                  class="prev"
                  data-controls="prev"
                  aria-controls="property"
                  tabindex="-1"
                  >Prev</span
                >
                <span
                  class="next"
                  data-controls="next"
                  aria-controls="property"
                  tabindex="-1"
                  >Next</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="container" >
    <div class="row" id = "views_property">
    <h1 id= "found"></h1>

    
    </div>
</div>

   

<?php
include "../footer.php";
?>
