<?php
include('conn.php');

$restaurantID = $_POST['restaurantID'];
$username = $_POST['ManagerUsername'];
$password = $_POST['ManagerPassword'];
$name = $_POST['ManagerName'];
$email = $_POST['ManagerEmail'];
$phoneNumber = $_POST['ManagerPhoneNumber'];

$password = password_hash($password, PASSWORD_DEFAULT);

$checkUsername = "SELECT * FROM staff WHERE StaffUsername='" . $username . "'";
$resultUsername = $conn->query($checkUsername);

$checkUsernameA = "SELECT * FROM account WHERE StaffUsername='" . $username . "'";
$resultUsernameA = $conn->query($checkUsernameA);

$checkEmail = "SELECT * FROM staff WHERE StaffEmail='" . $email . "'";
$resultEmail = $conn->query($checkEmail);

$checkEmailA = "SELECT * FROM account WHERE StaffEmail='" . $email . "'";
$resultEmailA = $conn->query($checkEmailA);

if ($resultUsername->num_rows > 0) {
    echo ("<script>
                window.alert('This username is exist, please use another username.');
                window.location.href='manageStaff.php';
                </script>");
} else if ($resultEmail->num_rows > 0) {
    echo ("<script>
                window.alert('This email is exist, please use another email.');
                window.location.href='manageStaff.php';
                </script>");
} else if ($resultUsernameA->num_rows > 0) {
    echo ("<script>
                window.alert('This username is exist, please use another username.');
                window.location.href='manageStaff.php';
                </script>");
} else if ($resultEmailA->num_rows > 0) {
    echo ("<script>
                window.alert('This email is exist, please use another email.');
                window.location.href='manageStaff.php';
                </script>");
} else {
    $sql = "INSERT INTO `staff`(`RestaurantID`, `StaffUsername`, `StaffPassword`, `StaffName`, `StaffPhoneNumber`, `StaffEmail`, `StaffPosition`) VALUES ($restaurantID, '$username', '$password', '$name','$phoneNumber', '$email', 'Manager')";


    if ($conn->query($sql) === TRUE) {
        header('location:manageManager.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }
}
