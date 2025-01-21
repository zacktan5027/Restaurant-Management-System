<?php
if (!isset($_GET['verify'])) {
  echo ("<script>
                window.location.href='index.php';
                </script>");
}
?>

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
              <h1 class="text-capitalize mb-4 font-lg text-white">Forget Password</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="intro-wrap bg-white w-100">
          <h1 style="font-size:36px">Change Password</h1>
          <hr>
          <form action="forgetpassword.php" method="post" autocomplete="off">
            <div>
              <label for="password"><b>Password</b></label>
              <div class="form-group">
                <input type="password" id="psw" name="AccountPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" maxlength="20" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <div id="error_msg2"></div>
              </div>
              <script>
                $(document).ready(function() {
                  $("#psw").keypress(function(e) {
                    $("#error_msg2").html("");
                    var key = e.keyCode;
                    $return = ((key >= 48 && key <= 57) || (key > 64 && key < 91) || (key > 96 && key < 123));
                    if (!$return) {
                      $("#error_msg2").html("No special characters Please!");
                      return false;
                    }
                  });
                });
              </script>
              <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
              </div>
            </div>
            <div class="form-group">
              <label for="password"><b>Re-enter Your Password</b></label>
              <div>
                <input type="password" id="psw2" name="AccountPassword2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" maxlength="20" placeholder="Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <div id="error_msg3"></div>
              </div>
              <script>
                $(document).ready(function() {
                  $("#psw2").keypress(function(e) {
                    $("#error_msg3").html("");
                    var key = e.keyCode;
                    $return = ((key >= 48 && key <= 57) || (key > 64 && key < 91) || (key > 96 && key < 123));
                    if (!$return) {
                      $("#error_msg3").html("No special characters Please!");
                      return false;
                    }
                  });
                });
              </script>
              <div id="message2">
                <h3>Password must match with the previous password:</h3>
                <p id="letter2" class="invalid"><b>Match</b></p>
              </div>
            </div>

            <div>
              <div>
                <input class="btn btn-main float-right" type="submit" name="submit" value="Submit" />
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

<script>
  var myInput = document.getElementById("psw");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var myInput2 = document.getElementById("psw2");

  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
  }

  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
  }

  // When the user clicks on the password field, show the message box
  myInput2.onfocus = function() {
    document.getElementById("message2").style.display = "block";
  }

  // When the user clicks outside of the password field, hide the message box
  myInput2.onblur = function() {
    document.getElementById("message2").style.display = "none";
  }

  // When the user starts to type something inside the password field
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }
  myInput2.onkeyup = function() {
    if (document.getElementById("psw2").value == document.getElementById("psw").value) {
      letter2.classList.remove("invalid");
      letter2.classList.add("valid");
    } else {
      letter2.classList.remove("valid");
      letter2.classList.add("invalid");
    }
  }
</script>

</html>