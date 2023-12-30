<?php
include "../header.php";
include "includes/property_view.php";
?>
<div class="container">
    <div class="row">
        <?php
        if ($property) {
            foreach ($property as $prop) {
        ?>
                <div class="col-md-4 col-lg-4 col-sm-12">
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
                            <div class="price mb-2"><span>₱ <?php echo $prop['price'];  ?></span></div>
                            <div>
                                <span class="d-block mb-2 text-black-50"><?php echo $prop['location'];  ?></span>
                                <span class="city d-block mb-3"><?php echo $prop['city_name'];  ?>, <?php echo $prop['province_name'];  ?></span>

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

                                <a href="property/property-single.html" class="btn btn-primary py-2 px-3">See details</a>
                            </div>
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
</div>

<?php include "../footer.php"; ?>