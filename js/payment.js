function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === "paste") {
    key = event.clipboardData.getData("text/plain");
  } else {
    // Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function cc_format(ccid) {
  var ccNumString = document.getElementById(ccid).value;
  ccNumString = ccNumString.replace(/[^0-9]/g, "");
  var block1 = "";
  var block2 = "";
  var block3 = "";
  var block4 = "";
  var formatted = "";

  block1 = ccNumString.substring(0, 4);
  block2 = ccNumString.substring(4, 8);
  block3 = ccNumString.substring(8, 12);
  block4 = ccNumString.substring(12, 16);

  if (ccNumString.length >= 5 && ccNumString.length <= 8) {
    formatted = block1 + " " + block2;
    document.getElementById(ccid).value = formatted;
  } else if (ccNumString.length >= 9 && ccNumString.length <= 12) {
    formatted = block1 + " " + block2 + " " + block3;
    document.getElementById(ccid).value = formatted;
  } else if (ccNumString.length >= 13) {
    formatted = block1 + " " + block2 + " " + block3 + " " + block4;
    document.getElementById(ccid).value = formatted;
  } else document.getElementById(ccid).value = ccNumString;
}

function date_format(expiredDate) {
  let dateNumString = document.getElementById(expiredDate).value;
  dateNumString = dateNumString.replace(/[^0-9]/g, "");
  let block1 = "";
  let formatted = "";

  // all support card types have a 4 digit first block
  block1 = dateNumString.substring(0, 2);
  if (block1 > 12) {
    dateNumString = dateNumString.substring(0, 1);
    document.getElementById(expiredDate).value = dateNumString;
    alert("You cannot input month more than 12.");
  }

  block2 = dateNumString.substring(2, 4);

  if (dateNumString.length >= 4) {
    let date = new Date();
    let year = date.getFullYear();
    if (block2 < year.toString().substring(2, 4)) {
      dateNumString = dateNumString.substring(0, 2);
      document.getElementById(expiredDate).value = dateNumString;
      alert("You cannot input year which is expired.");
    }
  }

  if (dateNumString.length >= 3) {
    formatted = block1 + "/" + block2;
    document.getElementById(expiredDate).value = formatted;
  } else document.getElementById(expiredDate).value = dateNumString;
}

$("#topUpValue").blur(function () {
  checkValue();
  $(".amount").val($(this).val());
});

function checkValue() {
  if (!$("#topUpValue").val() || $("#topUpValue").val() == 0) {
    $(".topup").prop("disabled", true);
  } else {
    $(".topup").prop("disabled", false);
  }
}
