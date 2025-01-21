<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Forget password</title>

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
              <h1 class="text-capitalize mb-4 font-lg text-white">Forget Password</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="intro-wrap bg-white w-100">
          <h1>Forget Password</h1>
          <hr>
          <form action="forgetpasswordcheckusername.php" method="post" autocomplete="off">
            <div class="container">
              <div>
                <label for="AccountUsername"><b>Username</b></label>
                <div>
                  <input type="text" name="AccountUsername" placeholder="Username" maxlength="25" id="AccountUsername" required>
                </div>
                <label for="Email"><b>Email</b></label>
                <div>
                  <input type="text" name="AccountEmail" placeholder="Email" id="AccountEmail" maxlength="30" required><br><br>
                </div>
              </div>
              <div>
                <div>
                  <input class="btn btn-main float-right" type="submit" name="submit" value="Submit" />
                </div>
              </div>
          </form><br><br>
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