<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Top Up</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">About us</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h2>Top-up E-Wallet</h2><br>
                <div class="col-lg-12">
                    <div class="row" id="amount">
                        <div class="col-md-10 col-lg-4">
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="5" style="width: 250px; margin:10px 0px;font-size:25px">5</button>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="50" style="width: 250px; margin:10px 0px;font-size:25px">50</button>
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-4">
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="10" style="width: 250px; margin:10px 0px;font-size:25px">10</button>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="100" style="width: 250px; margin:10px 0px;font-size:25px">100</button>
                            </div>
                        </div>
                        <div class="col-md-10 col-lg-4">
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="20" style="width: 250px; margin:10px 0px;font-size:25px">20</button>
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-main" value="500" style="width: 250px; margin:10px 0px;font-size:25px">500</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <form action="topupPayment.php" method="POST">
                        <div style="text-align: center;">
                            <div class="row">
                                <div class="col-md-10 col-lg-3" style="text-align:right">
                                    <h2>RM:</h2>
                                </div>
                                <div class="col-md-10 col-lg-9">
                                    <input style="width:70%;text-align:center;font-size:30px" class="form-control" id="topupValue" maxlength="4" type="text" name="value" value="">
                                </div>
                            </div>
                            <input class="btn btn-main" type="submit" name="topup" value="Pay now">
                        </div>
                </div>
                </form>
            </div>
            </div>
        </section>
    </section>
    <!--  Banner End -->

    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

<script>
    $(document).ready(function() {

        $('#amount button').click(function() {
            var amount = $(this).val();
            $("#topupValue").val(amount)
        });

        $("#topupValue").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

    });
</script>

</html>