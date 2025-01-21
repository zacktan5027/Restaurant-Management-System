<?php
include('conn.php');

$DishName = $_POST['DishName'];
$Dishprice = $_POST['Dishprice'];
$categoryid = $_POST['categoryid'];
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

$sql = "insert into dish (categoryid, DishName, Dishprice, Dishphoto, DishPerPax, DishDescription, DishSpiciness) value ('$categoryid','$DishName',  '$Dishprice', '$image','$DishPerPax', '$DishDescription', '$DishSpiciness')";


if ($conn->query($sql) === TRUE) {
	move_uploaded_file($_FILES["image"]["tmp_name"], $target);
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	exit();
}


header('location:product.php');
