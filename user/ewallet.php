<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-Wallet</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">E-Wallet</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h2>E-Wallet</h2>
                <div class="col-lg-12">
                    <?php
                    $sql = "select * from account WHERE AccountID ='" . $_SESSION['user']['id'] . "'";
                    $query = $conn->query($sql);
                    $row = $query->fetch_array();
                    ?>
                    <center>
                        Balance
                        <br><br>
                        <h1>RM <?= $row['AmountEwallet'] ?></h1>
                        <br>
                        <hr>
                        <a class="btn btn-main" style="width: 50%;" href="topup.php">Top up</a>
                    </center>
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