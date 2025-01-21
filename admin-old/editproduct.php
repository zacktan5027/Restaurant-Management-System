<?php
include('conn.php');

$id = $_GET['dish'];

$DishName = $_POST['DishName'];
$categoryid = $_POST['categoryid'];
$price = $_POST['DishPrice'];
$DishPerPax = $_POST['DishPerPax'];
$DishDescription = $_POST['DishDescription'];
$DishSpiciness = $_POST['DishSpiciness'];

$sql = "select * from dish where dishid='$id'";
$query = $conn->query($sql);
$row = $query->fetch_array();

if ($_FILES["image"]["error"] == 4) {
	$image = $row['DishPhoto'];
} else {
	$target_dir = "../upload/";
	$target = $target_dir . basename($_FILES["image"]["name"]);
	$image = $_FILES['image']['name'];
}

$sql = "update dish set DishName='$DishName', categoryid='$categoryid', Dishprice='$price', DishPerPax='$DishPerPax', DishDescription='$DishDescription', DishSpiciness='$DishSpiciness', DishPhoto='$image' where Dishid='$id'";
if ($conn->query($sql))
	move_uploaded_file($_FILES["image"]["tmp_name"], $target);

header('location:product.php');
