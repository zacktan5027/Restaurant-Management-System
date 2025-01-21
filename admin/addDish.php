<?php
include('conn.php');

$DishName = $_POST['DishName'];
$DishPrice = $_POST['DishPrice'];
$categoryID = $_POST['categoryID'];
$DishPerPax = $_POST['DishPerPax'];
$DishDescription = $_POST['DishDescription'];
$DishSpiciness = $_POST['DishSpiciness'];

if (empty($_FILES['image'])) {
	$image = "";
} else {
	$target_dir = "../upload/";
	$target = $target_dir . basename($_FILES["image"]["name"]);
	$image = $_FILES['image']['name'];
}

$sql = "insert into dish (CategoryID, DishName, DishPrice, DishPhoto, DishPerPax, DishDescription, DishSpiciness) value ('$categoryID','$DishName','$DishPrice', '$image','$DishPerPax', '$DishDescription', '$DishSpiciness')";


if ($conn->query($sql) === TRUE) {
	move_uploaded_file($_FILES["image"]["tmp_name"], $target);
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	exit();
}


header('location:manageDish.php');
