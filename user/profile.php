<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>

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
        <section class="section-header bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="text-capitalize mb-4 font-lg text-white">Profile</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-14 col-sm-14 col-lg-12">
                        <div class="details-form">
                            <h1 class="headline mb-3 font-weight-bold">Profile</h1>
                            <hr>
                            <div>
                                <table style="margin: auto;">
                                    <tr style="height: 50px;">
                                        <td style="width:300px">
                                            <h3>Name: </h3>
                                        </td>
                                        <td style="width:300px">
                                            <span><?= $_SESSION['user']['name'] ?></span>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>phoneNumber: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['phoneNumber'] ?></span><br>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>Address 1: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['address1'] ?></span><br>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>Address 2: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['address2'] ?></span><br>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>Post code: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['postcode'] ?></span><br>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>City: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['city'] ?></span><br>
                                        </td>
                                    </tr>
                                    <tr style="height: 50px;">
                                        <td>
                                            <h3>State: </h3>
                                        </td>
                                        <td>
                                            <span><?= $_SESSION['user']['state'] ?></span><br>
                                        </td>
                                    </tr>
                                </table>
                                <a class="btn btn-main float-left" href="securityquestion.php">Change Password</a>
                                <form action="editProfile.php" method="POST">
                                    <input type="submit" class="btn btn-main float-right" name="editProfile" value="edit Profile">
                                </form>
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