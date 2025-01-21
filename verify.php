<?php
require_once('conn.php');

$email = $_GET['email'];
$vkey = $_GET['vkey'];

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'restaurantmanagementsystem';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$query = "SELECT * FROM account WHERE VerificationKey ='" . $vkey . "' AND AccountEmail = '" . $email . "' ";
$result = mysqli_query($con, $query);
if ($result) {
    $query = "UPDATE `account` SET `Verification`= 1 WHERE AccountEmail='" . $email . "' ";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: verified.php?status=1");
    }
} else {
    header("Location: verified.php?status=0");
}
