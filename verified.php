<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Verified</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugins Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugins Close -->
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
                            <h1 class="text-capitalize mb-4 font-lg text-white">About us</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <?php if ($_GET['status'] == 1) { ?>
                        <div>
                            <h1>You are succesfully verified your account</h1>
                            <div class="row justify-content-center">
                                <a href="index.php" class="btn btn-main flo">Back to Home</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <h1>You fail or haven't verified your account</h1>
                            <div class="row justify-content-center">
                                <a href="index.php" class="btn btn-main flo">Back to Home</a>
                            </div>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </section>
    </section>
    <!--  Banner End -->


    </section>
    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

</html>