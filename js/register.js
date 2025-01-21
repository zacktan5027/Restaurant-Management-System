$(document).ready(function () {
  $("#username").keypress(function (e) {
    $("#error_msg").html("");
    let key = e.keyCode;
    $return =
      (key >= 48 && key <= 57) ||
      (key > 64 && key < 91) ||
      (key > 96 && key < 123);
    if (!$return) {
      $("#error_msg")
        .html("Please do not use special character (,./%_) in your input.")
        .show()
        .fadeOut("slow");
      return false;
    }
    if (e.which === 32) return false;
  });

  $("#pwd").keypress(function (e) {
    if (e.which === 32) return false;
  });

  $("#pwd2").keypress(function (e) {
    if (e.which === 32) return false;
  });

  $("#phoneNumber").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      $("#phone_error_msg").html("Number only").show().fadeOut("slow");
      return false;
    }
  });

  $("#postcode").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      //display error message
      $("#postcode_error_msg").html("Number only").show().fadeOut("slow");
      return false;
    }
  });

  let pwd = document.getElementById("pwd");
  let pwd2 = document.getElementById("pwd2");
  let letter = document.getElementById("letter");
  let capital = document.getElementById("capital");
  let number = document.getElementById("number");
  let length = document.getElementById("length");
  let username = document.getElementById("username");
  let email = document.getElementById("email");
  let name = document.getElementById("name");
  let phoneNumber = document.getElementById("phoneNumber");
  let address1 = document.getElementById("address1");
  let address2 = document.getElementById("address2");
  let postcode = document.getElementById("postcode");
  let district = document.getElementById("district");
  let state = document.getElementById("state");

  // When the user clicks on the password field, show the message box
  pwd.onfocus = function () {
    document.getElementById("message").style.display = "block";
    pwd.style.removeProperty("border");
  };

  // When the user clicks outside of the password field, hide the message box
  pwd.onblur = function () {
    document.getElementById("message").style.display = "none";
    if (pwd.value == "") {
      pwd.style.borderColor = "red";
    }
  };

  // When the user clicks on the password field, show the message box
  pwd2.onfocus = function () {
    document.getElementById("message2").style.display = "block";
    pwd2.style.removeProperty("border");
  };

  // When the user clicks outside of the password field, hide the message box
  pwd2.onblur = function () {
    document.getElementById("message2").style.display = "none";
    if (pwd2.value == "") {
      pwd2.style.borderColor = "red";
    }
  };

  // When the user starts to type something inside the password field
  pwd.onkeyup = function () {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (pwd.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (pwd.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (pwd.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }

    // Validate length
    if (pwd.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  };
  pwd2.onkeyup = function () {
    if (
      document.getElementById("pwd2").value ==
      document.getElementById("pwd").value
    ) {
      letter2.classList.remove("invalid");
      letter2.classList.add("valid");
    } else {
      letter2.classList.remove("valid");
      letter2.classList.add("invalid");
    }
  };

  function myFunction() {
    var x = document.getElementById("psw");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  // When the user clicks on the username field
  username.onfocus = function () {
    username.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  username.onblur = function () {
    if (username.value == "") {
      username.style.borderColor = "red";
    }
  };

  // When the user clicks on the username field
  email.onfocus = function () {
    email.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  email.onblur = function () {
    if (email.value == "") {
      email.style.borderColor = "red";
    }
  };

  // When the user clicks on the username field
  name.onfocus = function () {
    name.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  name.onblur = function () {
    if (name.value == "") {
      name.style.borderColor = "red";
    }
  };

  // When the user clicks on the username field
  phoneNumber.onfocus = function () {
    phoneNumber.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  phoneNumber.onblur = function () {
    if (phoneNumber.value == "") {
      phoneNumber.style.borderColor = "red";
    }
  };
  address1.onblur = function () {
    if (address1.value != "") {
      address2.required = true;
      postcode.required = true;
      district.required = true;
      state.required = true;
    } else {
      address2.required = false;
      postcode.required = false;
      district.required = false;
      state.required = false;
    }
  };

  // When the user clicks on the username field
  login_user.onfocus = function () {
    login_user.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  login_user.onblur = function () {
    if (login_user.value == "") {
      login_user.style.borderColor = "red";
    }
  };

  // When the user clicks on the username field
  login_pwd.onfocus = function () {
    login_pwd.style.removeProperty("border");
  };

  // When the user clicks outside of the username field and the input is empty use red box to highlight
  login_pwd.onblur = function () {
    if (login_pwd.value == "") {
      login_pwd.style.borderColor = "red";
    }
  };
});
