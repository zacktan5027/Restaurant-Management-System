<?php
require_once('conn.php');

if (!isset($_GET['found'])) {
  echo ("<script>
                window.location.href='index.php';
                </script>");
}

session_start();

$stmt = $conn->prepare('SELECT AccountPassword, AccountEmail FROM account WHERE AccountID = ?');

$stmt->bind_param('i', $_SESSION['AccountID']);
$stmt->execute();
$stmt->bind_result($AccountPassword, $AccountEmail);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Security Question</title>

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
        <div class="intro-wrap bg-white w-100">
          <h1>Security Question</h1>
          <form action="securityquestionprocess.php" method="post" autocomplete="off">
            <div class="container">
              <div>
                <div class="form-group">
                  <label for="security question"><b>Security Question:</b></label>
                  <div>
                    <select class="form-control" name="SecurityQuestion" required>
                      <option value="">Please choose one</option>
                      <option value="1">What is your primary school name</option>
                      <option value="2">What is your first pet name</option>
                      <option value="3">Where do you born at</option>
                      <option value="4">What is your mother's name</option>
                      <option value="5">What is your favourite hobby</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="security answer"><b>Security Answer</b></label>
                  <div>
                    <input class="form-control" type="text" name="SecurityAnswer" placeholder="Your answer" id="SecurityAnswer" required />
                  </div>
                </div>

                <div>
                  <div>
                    <input class="btn btn-main float-right" type="submit" name="submit" value="Submit" />
                  </div>
                </div>
              </div>
          </form>
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