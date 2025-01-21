<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugin Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugin Close -->
</head>


<body>
    <!-- Header Start -->

    <?php include('header.php'); ?>

    <!-- Header Close -->

    <section class="slider-hero hero-slider  hero-style-1  ">
        <section class="section-header bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="text-capitalize mb-4 font-lg text-white">Home</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-14 col-sm-14 col-lg-12">
                        <div class="row">
                            <div class="col-md-10 col-lg-6">
                                <h2>Manage</h2>
                                <hr>
                                <div class="from-group">
                                    <h3>Staff</h3>
                                    <a class="btn btn-main" href="manageStaff.php">Manage Staff</a>
                                </div><br>
                                <div class="from-group">
                                    <h3>Reservation</h3>
                                    <a class="btn btn-main" href="reservation.php">Manage Reservation</a>
                                </div><br>
                            </div>
                            <div class="col-md-10 col-lg-6">
                                <h2>Report </h2>
                                <hr>
                                <div class="form-g">
                                    <h3>Generate Report</h3>
                                    <a class="btn btn-main" href="report.php">View Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!--  Banner End -->

    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

</html>