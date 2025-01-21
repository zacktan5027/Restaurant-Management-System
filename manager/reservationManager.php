<?php
require_once "conn.php";


$status = $_POST['status'];
$id = $_POST['ReservationID'];
$email = $_POST['customerEmail'];
$name = $_POST['customerName'];
$date = $_POST['date'];
$time = $_POST['time'];
$message = "";

if ($status == 0) {
    echo "<script>location.assign('reservation.php');</script>";
} else if ($status == 1) {
    $status = "Approved";
    $message = "Thank you for choosing our restaurant. Congratulation," . $name . ". Your reservation on " . $date . " " . $time . " has been approved";
} else if ($status == 2) {
    $status = "Not Approved";
    $message = "Thank you for choosing our restaurant. Sorry," . $name . ". Your reservation on " . $date . " " . $time . " has not been approved";
}

$sql = "UPDATE reservation SET ReservationStatus = '$status' WHERE ReservationID = $id";
if (mysqli_query($conn, $sql)) {

    ini_set("smtp", "smtp.server.com");
    $to = "pubg25027@gmail.com";
    $subject = "Restaurant Management System - Reservation";
    $message = $message;
    $headers  = 'From: adhe.ansa@gmail.com';
    $headers .= "MIME-Version:1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to, $subject, $message, $headers);

    echo "<script>alert('Successfully updated!');</script>";
    echo "<script>location.assign('reservation.php');</script>";
}
