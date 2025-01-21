<?php
session_start();
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "restaurantmanagementsystem";
# Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
$AccountPassword = $_POST['AccountPassword'];
$AccountPassword2 = $_POST['AccountPassword2'];
$AccountUsername = $_SESSION['AccountUsername'];
if (mysqli_connect_error()) {
  die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
  if ($AccountPassword == $AccountPassword2) {
    if ($stmt = $conn->prepare("UPDATE account SET AccountPassword=? WHERE AccountUsername ='$AccountUsername'")) {
      $password3 = password_hash($_POST['AccountPassword'], PASSWORD_DEFAULT);
      $stmt->bind_param('s', $password3);
      $stmt->execute();
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Succesfully change, please sign in to your account.');
          window.location.href='index.php';
          </script>");
      session_destroy();
    } else {
      // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
      echo 'Could not prepare statement!';
    }
  } else {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Both of the password entered must be the same.');
      window.location.href='forgetpasswordindex2.php';
      </script>");
  }
}
$conn->close();
