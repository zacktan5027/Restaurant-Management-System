<?php
include('conn.php');

$id = $_GET['category'];
$active = $_GET['active'];

if ($active == 1) {
    $sql = "UPDATE `category` SET `activeCategory`=0 WHERE CategoryID='$id'";
    $conn->query($sql);
} else {
    $sql = "UPDATE `category` SET `activeCategory`=1 WHERE CategoryID='$id'";
    $conn->query($sql);
}

header('location:manageDishCategory.php');
