<?php
include('conn.php');

$id = $_POST['staffID'];
$name = $_POST['staffName'];
$email = $_POST['staffEmail'];
$phoneNumber = $_POST['staffPhoneNumber'];

$sql = "update staff set StaffName='$name', StaffPhoneNumber='$phoneNumber',StaffEmail='$email' where StaffID='$id'";
$conn->query($sql);

header('location:manageStaff.php');
