<?php
require_once('conn.php');

session_start();
$AccountUsername = $_SESSION['AccountUsername'];
if (mysqli_connect_error()) {
  die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
  if ($stmt = $conn->prepare('SELECT SecurityQuestion, SecurityAnswer FROM account WHERE AccountUsername = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $AccountUsername);
    $stmt->execute();
    $stmt->bind_result($SecurityQuestion, $SecurityAnswer);
    $stmt->fetch();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
  }
  if ($SecurityQuestion == $_POST['SecurityQuestion'] && $SecurityAnswer == $_POST['SecurityAnswer']) {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Succesfully verify your account.');
      window.location.href='forgetpasswordindex2.php?verify=1';
      </script>");
  } else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Fail to verify your account.');
      window.location.href='securityquestion.php';
    </script>");
  }
}
