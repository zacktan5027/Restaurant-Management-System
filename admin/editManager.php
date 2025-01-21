<?php
include('conn.php');

$id = $_POST['managerID'];
$restaurantID = $_POST['restaurantID'];

$sql = "update staff set RestaurantID='$restaurantID' where StaffID='$id'";
$conn->query($sql);

header('location:manageManager.php');
