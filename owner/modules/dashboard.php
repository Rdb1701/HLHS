<?php
include "../header.php";

$propertyy           = "";
$sellers             = "";
$av_property         = "";
$sold_properties     = "";
$pending_properties  = "";
$rejected_properties = "";
?>

<div class="row show-grid">
    <!-- Customer ROW -->
    <div class="col-md-4">
        <!-- students records -->
        <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xl fw-bold text-primary text-uppercase mb-1">No. Properties</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM property WHERE user_id = '" . $_SESSION['owner']['user_id'] . "'";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";
                                    $propertyy = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-building"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <!-- Request record -->
        <div class="col-md-12 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">No. of Sellers</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM user_seller WHERE owner_id = '" . $_SESSION['owner']['user_id'] . "'";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";

                                    $sellers = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-users"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Request record -->
        <div class="col-md-12 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">No. Available Properties</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM property WHERE user_id = '" . $_SESSION['owner']['user_id'] . "' AND property_status = 1";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";
                                    $av_property = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-building"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- Request record -->
        <div class="col-md-12 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">No. of Sold Properties</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM property WHERE user_id = '" . $_SESSION['owner']['user_id'] . "' AND property_status = 0";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";
                                    $sold_properties = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-money-bill"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <!-- Approved record -->
        <div class="col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">No. of Pending Properties</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM property WHERE user_id = '" . $_SESSION['owner']['user_id'] . "' AND status = 0";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";
                                    $pending_properties = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-spinner"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Approved record -->
        <div class="col-md-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-0">
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">No. of Rejected Properties</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                                <?php
                                $query = "SELECT COUNT(*) FROM property WHERE user_id = '" . $_SESSION['owner']['user_id'] . "' AND status = 2";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "$row[0]";
                                    $rejected_properties = $row[0];
                                }
                                ?> Record(s)
                            </div>
                        </div>
                        <div class="col-auto">
                            <h2 class="fa fa-times-circle"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <canvas id="bar_graph"></canvas>
    <?php
    include "../footer.php";
    ?>
    <script src="../assets/js/chart.min.js"></script>

    <script>
        const ctx = document.getElementById('bar_graph');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Properties', 'Sellers', 'Available Properties', 'Sold Properties', 'Pending Properties', 'Rejected Properties'],
                datasets: [{
                    label: 'Dashboard',
                    data: [<?php echo $propertyy; ?>, <?php echo $sellers; ?>, <?php echo $av_property; ?>, <?php echo $sold_properties; ?>, <?php echo $pending_properties; ?>, <?php echo $rejected_properties; ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>