<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugins Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugins Close -->
</head>

<style>
    #message {
        display: none;
        background: #f5f5f5;
        color: #000;
        position: relative;
        padding: 20px;
        margin-top: 10px;
    }

    #message p {
        padding: 10px 35px;
        font-size: 18px;
    }

    #message2 {
        display: none;
        background: #f5f5f5;
        color: #000;
        position: relative;
        padding: 20px;
        margin-top: 10px;
    }

    #message2 p {
        padding: 10px 35px;
        font-size: 18px;
    }

    /* Add a green text color and a checkmark when the requirements are right */
    .valid {
        color: green;
    }

    .valid:before {
        position: relative;
        left: -35px;
        content: "✔";
    }

    /* Add a red text color and an "x" icon when the requirements are wrong */
    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        left: -35px;
        content: "✖";
    }
</style>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Register</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h1>Register Account</h1>
                <hr>
                <div class="row">
                    <div class="col-md-14 col-sm-14 col-lg-12">
                        <div class="details-form">

                            <form action="registerManager.php" id="bookingForm" method="post">
                                <div class="form-group">
                                    <label>Username <span style="color:red" id="error_msg"></span></label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter Username" name="AccountUsername" maxlength="40" required>

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="pwd" type="password" class="form-control" placeholder="Enter Password" name="AccountPassword" minlength="8" maxlength="12" required>
                                    <div id="message">
                                        <h3>Password must contain the following:</h3>
                                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                        <p id="number" class="invalid">A <b>number</b></p>
                                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="pwd2" type="password" class="form-control" placeholder="Confirm Password" name="AccountPassword2" minlength="8" maxlength="12" required>
                                    <div id="message2">
                                        <h3>Password must match with the previous password:</h3>
                                        <p id="letter2" class="invalid"><b>Match</b></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" id="email" name="AccountEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3}" maxlength="30" placeholder=" Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="AccountName" placeholder="Enter Name" maxlength="30" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number <span style="color:red" id="phone_error_msg"></span></label>
                                    <input type="text" class="form-control" id="phoneNumber" name="AccountPhoneNumber" placeholder="Enter Phone Number" pattern=".{10,11}" maxlength="11" required>
                                </div>
                                <hr>
                                <h2 class="headline mb-3 font-weight-bold">Address</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-10 col-lg-6">
                                        <div class="form-group">
                                            <label>Address1 <small style="color:gray">(1A, Lorong 9)</small> </label>
                                            <input type="text" id="address1" class="form-control" name="AccountAddress1" placeholder="Enter Address 1" maxlength="30">
                                        </div>
                                        <div class="form-group">
                                            <label>Address2 <small style="color:gray">(Taman Sejati Indah)</small> </label>
                                            <input type="text" id="address2" class="form-control" name="AccountAddress2" placeholder="Enter Address 2" maxlength="30">
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="district" class="form-control" name="AccountCity" placeholder="Enter City" maxlength="30">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control" id="state" name="AccountState" style="margin:7px 0 25px 0">
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
                                        <div class="form-group">
                                            <label>Post Code</label>
                                            <input type="text" id="postcode" class="form-control" name="AccountPostcode" placeholder="Postcode" pattern=".{5,5}" maxlength="5" style="margin:10px 0 10px 0">
                                            <span id="postcode_error_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h2 class="headline mb-3 font-weight-bold">Security</h2>
                                <hr>
                                <div class="form-group">
                                    <label>Security Question</label>
                                    <select name="SecurityQuestion" class="form-control" required>
                                        <option value="">Please choose one</option>
                                        <option value="1">What is your primary school name</option>
                                        <option value="2">What is your first pet name</option>
                                        <option value="3">Where do you born at</option>
                                        <option value="4">What is your mother's name</option>
                                        <option value="5">What is your favourite hobby</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Security Answer</label>
                                    <input type="text" class="form-control" name="SecurityAnswer" placeholder="Your answer" id="SecurityAnswer" maxlength="30" required>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <input class="btn btn-main float-right" type="submit" id="submit" name="register" value="Register">
                                    </div>
                                </div>
                            </form>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/register.js"></script>

</html>