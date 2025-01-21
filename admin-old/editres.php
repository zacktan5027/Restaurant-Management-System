<?php
include('conn.php');

$id = $_GET['restaurant'];

$RestaurantName = $_POST['RestaurantName'];
$RestaurantAddress1 = $_POST['RestaurantAddress1'];
$RestaurantAddress2 = $_POST['RestaurantAddress2'];
$RestaurantPostcode = $_POST['RestaurantPostcode'];
$RestaurantDistrict = $_POST['RestaurantDistrict'];
$RestaurantState = $_POST['RestaurantState'];
$table2 = $_POST['table2'];
$table4 = $_POST['table4'];
$table8 = $_POST['table8'];

$sql = "select * from restaurant where RestaurantID='$id'";
$query = $conn->query($sql);
$row = $query->fetch_array();

$fileinfo = PATHINFO($_FILES["RestaurantPhoto"]["name"]);

if (empty($fileinfo['RestaurantPhoto'])) {
	$location = $row['RestaurantPhoto'];
} else {
	$newFilename = $fileinfo['RestaurantPhoto'] . "_" . time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["RestaurantPhoto"]["tmp_name"], $newFilename);
	$location = $newFilename;
}

$sql = "UPDATE `restaurant` SET `RestaurantPhoto`= '$location',`RestaurantName`='$RestaurantName',`RestaurantAddress1`='$RestaurantAddress1',`RestaurantAddress2`='$RestaurantAddress2',`RestaurantPostcode`=$RestaurantPostcode,`RestaurantDistrict`='$RestaurantDistrict',`RestaurantState`='$RestaurantState',`table2`=$table2,`table4`=$table4,`table8`=$table8 WHERE  RestaurantID='$id'";
$conn->query($sql);

header('location:restaurant.php');
