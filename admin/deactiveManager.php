<?php
include('conn.php');

$id = $_GET['manager'];
$active = $_GET['active'];
if ($active == 1) {
    $sql = "UPDATE `staff` SET `active`=0 WHERE StaffID='$id'";
    $conn->query($sql);
} else {
    $sql = "UPDATE `staff` SET `active`=1 WHERE StaffID='$id'";
    $conn->query($sql);
}

header('location:manageManager.php');
