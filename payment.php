<?php
require_once "conn.php";

if (!isset($_POST['totalPrice'])) {
  echo ("<script>
                window.location.href='index.php';
                </script>");
}

$totalPrice = $_POST['totalPrice'];

$deliveryFee = 0;

if ($totalPrice > 40) {
  $deliveryFee = 0;
} else {
  $deliveryFee = 5;
}

$grandTotal = $totalPrice * 1.06 + $deliveryFee;

$state = $_POST['AccountState'];

$sql = "SELECT RestaurantID FROM restaurant WHERE RestaurantState = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $state);
$stmt->execute();
$stmt->bind_result($restaurantID);
$stmt->fetch();
$stmt->close();

if ($restaurantID == null) {
  echo ("<script>
                window.alert('Sorry, delivery is not available in your area.');
                window.location.href='delivery.php';
                </script>");
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Payment</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Plugins Start -->

  <?php include('plugins.php'); ?>

  <!-- Plugins Close -->

</head>

<style>
  #message1 {
    display: none;
  }

  #message2 {
    display: none;
  }

  #message3 {
    display: none;
  }

  #message4 {
    display: none;
  }
</style>

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
            <h1 class="text-capitalize mb-4 font-lg text-white">Payment</h1>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section payment">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class=" payment-form py-6">
            <h1>Payment Method</h1>

            <input type="radio" id="fpx" name="gender" value="fpx">
            <label for="fpx">FPX</label><br>
            <div id="message1" class="form">
              <form method="post" action="paymentManager.php">
                <div class="form-group">
                  <select name="bankName" class="form-control">
                    <option value="1">Maybank</option>
                    <option value="2">CIMB Bank</option>
                    <option value="3">Public Bank Berhad</option>
                    <option value="4">RHB Bank</option>
                    <option value="5">Hong Leong Bank</option>
                    <option value="6">AmBank</option>
                    <option value="7">UOB Malaysia Bank</option>
                    <option value="8">Bank Rakyat</option>
                    <option value="9">OCBC Bank Malaysia</option>
                    <option value="10">HSBC Bank Malaysia</option>
                    <option value="11">Affin Bank</option>
                    <option value="12">Bank Islam Malaysia</option>
                    <option value="13">Standard Chartered Bank Malaysia</option>
                    <option value="14">CitiBank Malaysia </option>
                    <option value="15">Bank Simpanan Nasional (BSN)</option>
                    <option value="16">Bank Muamalat Malaysia Berhad</option>
                    <option value="17">Alliance Bank</option>
                    <option value="18">Agrobank</option>
                    <option value="19">Al-Rajhi Malaysia</option>
                    <option value="20">MBSB Bank Berhad</option>
                    <option value="21">Co-op Bank Pertama</option>
                  </select>
                  <input type="hidden" name="AccountID" value="0">
                  <input type="hidden" name="AccountName" value="<?= $_POST['AccountName'] ?>">
                  <input type="hidden" name="AccountEmail" value="<?= $_POST['AccountEmail'] ?>">
                  <input type="hidden" name="AccountAddress1" value="<?= $_POST['AccountAddress1'] ?>">
                  <input type="hidden" name="AccountAddress2" value="<?= $_POST['AccountAddress2'] ?>">
                  <input type="hidden" name="AccountCity" value="<?= $_POST['AccountCity'] ?>">
                  <input type="hidden" name="AccountState" value="<?= $_POST['AccountState'] ?>">
                  <input type="hidden" name="AccountPostcode" value="<?= $_POST['AccountPostcode'] ?>">
                  <input type="hidden" name="AccountPhoneNumber" value="<?= $_POST['AccountPhoneNumber'] ?>">
                  <input type="hidden" name="note" value="<?= $_POST['note'] ?>">
                  <input type="hidden" name="method" value="fpx">
                  <input type="hidden" name="total" value=<?= $grandTotal ?>>
                  <input type="submit" name="payment" class="btn btn-main" value="Submit">
                </div>
              </form>
            </div>

            <input type="radio" id="debit" name="gender" value="debit">
            <label for="debit">Debit card/ Credit card</label><br>
            <div id="message2">
              <h1>Add Credit/Debit Card</h1>
              <form method="post" action="paymentManager.php">
                <p>Account Holder Name</p>
                <input type="text" id="holderName" name="AccountName" placeholder="Name on card" maxlength="30" required>
                <p>Account Debit Card</p>
                <input type="text" id="cstCCNumber" name="AccountDebitCard" placeholder="Card Number" onkeyup="cc_format('cstCCNumber');" maxlength="19" required>
                <p>Card Verification Number</p>
                <input type="password" id="cvs" name="AccountDebitCard" placeholder="Card Verification Number" maxlength="3" required>
                <p>Expired Date</p>
                <input type="text" id="date" name="DebitCardDate" onkeyup="date_format('date');" placeholder="Expiration" maxlength="5" required> <br><br>

                <input type="hidden" name="AccountID" value="0">
                <input type="hidden" name="AccountName" value="<?= $_POST['AccountName'] ?>">
                <input type="hidden" name="AccountEmail" value="<?= $_POST['AccountEmail'] ?>">
                <input type="hidden" name="AccountAddress1" value="<?= $_POST['AccountAddress1'] ?>">
                <input type="hidden" name="AccountAddress2" value="<?= $_POST['AccountAddress2'] ?>">
                <input type="hidden" name="AccountCity" value="<?= $_POST['AccountCity'] ?>">
                <input type="hidden" name="AccountState" value="<?= $_POST['AccountState'] ?>">
                <input type="hidden" name="AccountPostcode" value="<?= $_POST['AccountPostcode'] ?>">
                <input type="hidden" name="AccountPhoneNumber" value="<?= $_POST['AccountPhoneNumber'] ?>">
                <input type="hidden" name="note" value="<?= $_POST['note'] ?>">
                <input type="hidden" name="method" value="debit">
                <input type="hidden" name="total" value=<?= $grandTotal ?>>
                <input type="submit" name="payment" class="btn btn-main" value="Submit">
              </form><br>
            </div>

            <input type="radio" id="cod" name="gender" value="cod">
            <label for="cod">Cash on delivery</label>
            <div id="message3">
              <form method="post" action="paymentManager.php">
                <input type="hidden" name="AccountID" value="0">
                <input type="hidden" name="AccountName" value="<?= $_POST['AccountName'] ?>">
                <input type="hidden" name="AccountEmail" value="<?= $_POST['AccountEmail'] ?>">
                <input type="hidden" name="AccountAddress1" value="<?= $_POST['AccountAddress1'] ?>">
                <input type="hidden" name="AccountAddress2" value="<?= $_POST['AccountAddress2'] ?>">
                <input type="hidden" name="AccountCity" value="<?= $_POST['AccountCity'] ?>">
                <input type="hidden" name="AccountState" value="<?= $_POST['AccountState'] ?>">
                <input type="hidden" name="AccountPostcode" value="<?= $_POST['AccountPostcode'] ?>">
                <input type="hidden" name="AccountPhoneNumber" value="<?= $_POST['AccountPhoneNumber'] ?>">
                <input type="hidden" name="note" value="<?= $_POST['note'] ?>">
                <input type="hidden" name="method" value="cod">
                <input type="hidden" name="total" value=<?= $grandTotal ?>>
                <input type="submit" name="payment" class="btn btn-main" value="Submit">
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <div class="card border-0 px-xl-5 secondary-bg py-4 px-4 mt-5 mt-lg-0">
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
                  echo sprintf('%0.2f', $deliveryFee);
                } else {
                  echo sprintf('%0.2f', $deliveryFee);
                }
                ?></span>
            </div>

            <div class="media align-items-center border-bottom font-weight-medium py-3">
              <div class="media-body">
                <span>Estimated Tax</span>
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
<script src="js/payment.js"></script>
<script>
  let fpx = document.getElementById("fpx");
  let debit = document.getElementById("debit");
  let ewallet = document.getElementById("ewallet");

  // When the user clicks on the password field, show the message box
  fpx.onfocus = function() {
    document.getElementById("message1").style.display = "block";
    document.getElementById("message2").style.display = "none";
    document.getElementById("message3").style.display = "none";

  };

  debit.onfocus = function() {
    document.getElementById("message1").style.display = "none";
    document.getElementById("message2").style.display = "block";
    document.getElementById("message3").style.display = "none";

  };

  cod.onfocus = function() {
    document.getElementById("message1").style.display = "none";
    document.getElementById("message2").style.display = "none";
    document.getElementById("message3").style.display = "block";
  };

  $("select[value]").each(function() {
    $(this).val(this.getAttribute("value"));
  });

  $("#cvs").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      $("#postcode_error_msg").html("Number only").show().fadeOut("slow");
      return false;
    }
  });


  $("#holderName").keypress(function(e) {
    //if the letter is not digit then display error and don't type anything
    if (!((e.which == 8) || (e.which == 32) || (e.which == 46) || (e.which >= 35 && e.which <= 40) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122))) {
      //display error message
      return false;
    }
  });
</script>

</html>