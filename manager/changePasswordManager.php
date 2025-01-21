<?php

session_start();
require_once "conn.php";

$AccountPassword = $_POST['AccountPassword'];
$AccountPassword2 = $_POST['AccountPassword2'];
$id = $_SESSION['user']['id'];

if (mysqli_connect_error()) {
    die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
    if ($AccountPassword == $AccountPassword2) {
        if ($stmt = $conn->prepare("UPDATE staff SET StaffPassword=? WHERE StaffID ='$id'")) {
            $password3 = password_hash($_POST['AccountPassword'], PASSWORD_DEFAULT);
            $stmt->bind_param('s', $password3);
            $stmt->execute();
            echo ("<script LANGUAGE='JavaScript'>
          window.alert('Succesfully change, please sign in again to your account.');
          window.location.href='logout.php';
          </script>");
        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
            echo 'Could not prepare statement!';
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'>
      window.alert('Both of the password entered must be the same.');
      window.location.href='changePassword.php';
      </script>");
    }
}
$conn->close();
