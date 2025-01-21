<?php

if (!isset($_POST['editProfile'])) {
    echo ("<script>
                window.location.href='index.php';
                </script>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>

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
                                <div class="row">
                                    <div class="col-md-10 col-lg-2">
                                    </div>
                                    <div class="col-md-10 col-lg-4">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <h3>Name:</h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>Phone Number: <span style="color:red" id="phone_error_msg"></span></h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>Address 1:</h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>Address 2:</h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>Post code: <span style="color:red" id="postcode_error_msg"></span></h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>City:</h3>
                                        </div>
                                        <div class="form-group" style="margin-top: 30px;">
                                            <h3>State:</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-6">
                                        <form action="profileManager.php" method="post">
                                            <div class="form-group">
                                                <input type="text" id="name" class="form-control" name="AccountName" placeholder="Enter Name" value="<?= $_SESSION['user']['name'] ?>" maxlength="30" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="phoneNumber" name="AccountPhoneNumber" placeholder="Enter Phone Number" value="<?= $_SESSION['user']['phoneNumber'] ?>" pattern=".{10,11}" maxlength="11" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="address1" class="form-control" name="AccountAddress1" placeholder="Enter Address 1" value="<?= $_SESSION['user']['address1'] ?>" maxlength="20" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="address2" class="form-control" name="AccountAddress2" placeholder="Enter Address 2" value="<?= $_SESSION['user']['address2'] ?>" maxlength="20" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="postcode" class="form-control" name="AccountPostcode" placeholder="Postcode" value="<?= $_SESSION['user']['postcode'] ?>" pattern=".{5,5}" maxlength="5" style="margin:10px 0 10px 0" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="district" class="form-control" name="AccountCity" placeholder="Enter City" value="<?= $_SESSION['user']['city'] ?>" maxlength="20" required>
                                            </div>
                                            <div class="form-group">
                                                <select value="<?= $_SESSION['user']['state'] ?>" class="form-control" id="state" name="AccountState" style="margin:7px 0 25px 0" required>
                                                    <option value="">Please choose one</option>
                                                    <option value="Kedah">Kedah</option>
                                                    <option value="Pulau Penang">Pulau Penang</option>
                                                    <option value="Perlis">Perlis</option>
                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                    <option value="Malacca">Malacca</option>
                                                    <option value="Selangor">Selangor</option>
                                                    <option value="Perak">Perak</option>
                                                    <option value="Johor">Johor</option>
                                                    <option value="Terengganu">Terengganu</option>
                                                    <option value="Kelantan">Kelantan</option>
                                                    <option value="Pahang">Pahang</option>
                                                    <option value="Sabah">Sabah</option>
                                                    <option value="Sarawak">Sarawak</option>
                                                </select>
                                            </div>
                                            <input type="submit" value="SAVE" class="btn btn-main float-right">
                                            <a href="profile.php" style="float: right;margin-right:10px" class="btn btn-main">Back</a>
                                        </form>
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

<script>
    $(document).ready(function() {

        $("#phoneNumber").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#phone_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

        $("#postcode").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#postcode_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

        let name = document.getElementById("name");
        let phoneNumber = document.getElementById("phoneNumber");
        let address1 = document.getElementById("address1");
        let address2 = document.getElementById("address2");
        let postcode = document.getElementById("postcode");
        let district = document.getElementById("district");
        let state = document.getElementById("state");

        // When the user clicks on the username field
        name.onfocus = function() {
            name.style.removeProperty("border");
        };

        // When the user clicks outside of the username field and the input is empty use red box to highlight
        name.onblur = function() {
            if (name.value == "") {
                name.style.borderColor = "red";
            }
        };

        // When the user clicks on the username field
        phoneNumber.onfocus = function() {
            phoneNumber.style.removeProperty("border");
        };

        // When the user clicks outside of the username field and the input is empty use red box to highlight
        phoneNumber.onblur = function() {
            if (phoneNumber.value == "") {
                phoneNumber.style.borderColor = "red";
            }
        };

        $("select[value]").each(function() {
            $(this).val(this.getAttribute("value"));
        })
    });
</script>

</html>