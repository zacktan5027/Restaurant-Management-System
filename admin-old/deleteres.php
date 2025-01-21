<?php
	include('conn.php');

	$id = $_GET['restaurant'];

	$sql="delete from restaurant where RestaurantID='$id'";
	$conn->query($sql);

	header('location:restaurant.php');
?>