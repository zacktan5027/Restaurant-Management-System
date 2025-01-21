<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_POST['checkout'])) {
  echo ("<script>
                window.location.href='index.php';
                </script>");
}

if (isset($_POST['totalPrice']))
  $_SESSION['totalPrice'] = $_POST['totalPrice'];

$totalPrice = $_SESSION['totalPrice'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Delivery</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Plugins Start -->

  <?php include('plugins.php'); ?>

  <!-- Plugins Close -->

</head>

<body>
  <div class="preloader">
    <img src="images/preloader.gif" alt="preloader" class="img-fluid">
  </div>
  <!-- Header Start -->

  <?php include('header.php'); ?>

  <!-- Header Close -->
  <section class="section-header bg-1">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center">
            <h1 class="text-capitalize mb-4 font-lg text-white">Checkout</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section shipping">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-8">
          <div class="details-form">
            <h3 class="headline mb-3 font-weight-bold">Your Details</h3>
            <hr>
            <form action="payment.php" id="bookingForm" method="post">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="AccountName" value="<?= $_SESSION['user']['name'] ?>" required>
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input class="form-control" type="text" id="email" name="AccountEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3}" maxlength="30" value="<?= $_SESSION['user']['email'] ?>" placeholder=" Enter Email" required>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>Address1 <small style="color:gray">(1A, Lorong 9)</small> </label>
                    <input type="text" class="form-control" placeholder="Enter Address 1" name="AccountAddress1" value="<?= $_SESSION['user']['address1'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Address2 <small style="color:gray">(Taman Sejati Indah)</small> </label>
                    <input type="text" class="form-control" placeholder="Enter Address 2" name="AccountAddress2" value="<?= $_SESSION['user']['address2'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="City" name="AccountCity" value="<?= $_SESSION['user']['city'] ?>" required>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="form-group">
                    <label>State</label>
                    <select value="<?= $_SESSION['user']['state'] ?>" class="form-control" name="AccountState" required>
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
                    <label>Post Code <span style="color:red" id="postcode_error_msg"></span></label>
                    <input type="text" id="postcode" class="form-control" name="AccountPostcode" placeholder="Postcode" style="margin:3px 0 8px 0" pattern=".{5,5}" maxlength="5" value="<?= $_SESSION['user']['postcode'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Phone Number <span style="color:red" id="phone_error_msg"></span></label>
                    <input type="text" class="form-control" id="phoneNumber" name="AccountPhoneNumber" placeholder="Enter Phone Number" maxlength="11" value="<?= $_SESSION['user']['phoneNumber'] ?>" required>
                  </div>
                </div>
                <div class="col-lg-12">
                  <label>Notes</label>
                  <textarea class="form-control" placeholder="Special Requirements" rows="5" name="note"></textarea>
                  <div class="mt-4">
                    <?php
                    $deliveryFee = 0;
                    if ($totalPrice > 40)
                      $deliveryFee = 0;
                    else
                      $deliveryFee = 5;
                    $totalPrice * 1.06 + $deliveryFee;
                    ?>
                    <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
                    <input type="submit" name="deliver" value="CONTINUE TO PAYMENT" class="btn btn-main float-right">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <div class="card border-0 px-xl-5 secondary-bg py-4 mt-5 mt-lg-0 px-4">
            <div class="">
              <h4 class="text-dark font-size-20">Order Summery</h4>
              <hr>
            </div>

            <div class="media align-items-center border-bottom font-weight-medium py-3">
              <div class="media-body">
                <span>Subtotal</span>
              </div>
              <span class="text-dark">RM<?= sprintf('%0.2f', $totalPrice) ?></span>
            </div>

            <div class="media align-items-center border-bottom font-weight-medium py-3">
              <div class="media-body">
                <span>Delivery Fee <br> <span style="color:grey;font-size:13px">(Free shipping above RM40 order)</span> </span>
              </div>
              <span class="text-dark">RM
                <?php
                $deliveryFee = 0;
                if ($totalPrice > 40) {
                  $deliveryFee = 0;
                  echo sprintf('%0.2f', $deliveryFee);
                } else {
                  $deliveryFee = 5;
                  echo sprintf('%0.2f', $deliveryFee);
                }
                ?></span>
            </div>

            <div class="media align-items-center border-bottom font-weight-medium py-3">
              <div class="media-body">
                <span>Estimated Tax(6%)</span>
              </div>
              <span class="text-dark">RM<?php echo sprintf('%0.2f', $totalPrice * 0.06) ?></span>
            </div>

            <div class="media justify-content-between align-items-center py-3">
              <span class="text-dark ">Grand Total</span>
              <span class="text-dark font-weight-bold">RM<?= sprintf('%0.2f', $totalPrice * 1.06 + $deliveryFee) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!--Footer start -->

  <?php include('footer.php'); ?>

  <!-- Footer  End -->
</body>

<script>
  $("#postcode").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      $("#postcode_error_msg").html("Number only").show().fadeOut("slow");
      return false;
    }
  });


  $("#phoneNumber").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      $("#phone_error_msg").html("Number only").show().fadeOut("slow");
      return false;
    }
  });

  $("select[value]").each(function() {
    $(this).val(this.getAttribute("value"));
  })
</script>

</html>