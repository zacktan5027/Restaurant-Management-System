<?php
include('conn.php');

$id = $_GET['category'];
$cname = $_POST['cname'];
$cname = strtoupper($cname);

$sql = "update category set CategoryName='$cname' where CategoryID='$id'";
$conn->query($sql);

header('location:manageDishCategory.php');
