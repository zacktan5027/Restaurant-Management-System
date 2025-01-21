<?php
include('conn.php');

$id = $_GET['staff'];
$active = $_GET['active'];
if ($active == 1) {
    $sql = "UPDATE `staff` SET `active`=0 WHERE StaffID='$id'";
    $conn->query($sql);
} else {
    $sql = "UPDATE `staff` SET `active`=1 WHERE StaffID='$id'";
    $conn->query($sql);
}

header('location:manageStaff.php');
