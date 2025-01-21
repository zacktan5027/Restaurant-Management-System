<?php
include('conn.php');

$id = $_GET['restaurant'];

$RestaurantName = $_POST['RestaurantName'];
$RestaurantAddress1 = $_POST['RestaurantAddress1'];
$RestaurantAddress2 = $_POST['RestaurantAddress2'];
$RestaurantPostcode = $_POST['RestaurantPostcode'];
$RestaurantCity = $_POST['RestaurantCity'];
$RestaurantState = $_POST['RestaurantState'];
$table2 = $_POST['table2'];
$table4 = $_POST['table4'];
$table8 = $_POST['table8'];

$sql = "select * from restaurant where RestaurantID='$id'";
$query = $conn->query($sql);
$row = $query->fetch_array();

if ($_FILES["image"]["error"] == 4) {
    $image = $row['RestaurantPhoto'];
} else {
    $target_dir = "../upload/";
    $target = $target_dir . basename($_FILES["image"]["name"]);
    $image = $_FILES['image']['name'];
}

$sql = "UPDATE `restaurant` SET `RestaurantPhoto`= '$image',`RestaurantName`='$RestaurantName',`RestaurantAddress1`='$RestaurantAddress1',`RestaurantAddress2`='$RestaurantAddress2',`RestaurantPostcode`=$RestaurantPostcode,`RestaurantCity`='$RestaurantCity',`RestaurantState`='$RestaurantState',`table2`=$table2,`table4`=$table4,`table8`=$table8 WHERE  RestaurantID='$id'";
$conn->query($sql);
if ($conn->query($sql))
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);

header('location:manageRestaurant.php');
