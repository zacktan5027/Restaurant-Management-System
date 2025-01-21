<?php

$conn = new mysqli('localhost', 'root', '', 'restaurantmanagementsystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>