<?php
include('conn.php');

$RestaurantName = $_POST['RestaurantName'];
$RestaurantAddress1 = $_POST['RestaurantAddress1'];
$RestaurantAddress2 = $_POST['RestaurantAddress2'];
$RestaurantPostcode = $_POST['RestaurantPostcode'];
$RestaurantCity = $_POST['RestaurantCity'];
$RestaurantState = $_POST['RestaurantState'];
$table2 = $_POST['table2'];
$table4 = $_POST['table4'];
$table8 = $_POST['table8'];

if (empty($_FILES['image'])) {
    $image = "";
} else {
    $target_dir = "../upload/";
    $target = $target_dir . basename($_FILES["image"]["name"]);
    $image = $_FILES['image']['name'];
}

$sql = "insert into restaurant (`RestaurantPhoto`, `RestaurantName`, `RestaurantAddress1`, `RestaurantAddress2`, `RestaurantPostcode`, `RestaurantCity`, `RestaurantState`, `table2`, `table4`, `table8`)
	 value ('$image','$RestaurantName','$RestaurantAddress1',  '$RestaurantAddress2', '$RestaurantPostcode','$RestaurantCity','$RestaurantState',$table2,$table4,$table8)";



if ($conn->query($sql) === TRUE) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}


header('location:manageRestaurant.php');
