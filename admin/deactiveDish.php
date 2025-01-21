<?php
include('conn.php');

$id = $_GET['dish'];
$active = $_GET['active'];
if ($active == 1) {
    $sql = "UPDATE `dish` SET `active`=0 WHERE DishID='$id'";
    $conn->query($sql);
} else {
    $sql = "UPDATE `dish` SET `active`=1 WHERE DishID='$id'";
    $conn->query($sql);
}

header('location:manageDish.php');
