<?php
	include('conn.php');

	$reststate=$_POST['reststate'];

	$sql="insert into restcat (reststate) values ('$reststate')";
	$conn->query($sql);

	header('location:restcat.php');
