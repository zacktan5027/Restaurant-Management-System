<?php
session_start();
include('conn.php');

$restaurantID = $_SESSION['user']['resid'];
$username = $_POST['staffUsername'];
$password = $_POST['staffPassword'];
$password2 = $_POST['staffPassword2'];
$name = $_POST['staffName'];
$email = $_POST['staffEmail'];
$phoneNumber = $_POST['staffPhoneNumber'];

if ($password !== $password2) {
    echo ("<script>
                window.alert('Password not the same');
                window.location.href='manageStaff.php';
                </script>");
}

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
    $sql = "INSERT INTO `staff`(`RestaurantID`, `StaffUsername`, `StaffPassword`, `StaffName`, `StaffPhoneNumber`, `StaffEmail`, `StaffPosition`) VALUES ($restaurantID, '$username', '$password', '$name','$phoneNumber', '$email', 'Staff')";


    if ($conn->query($sql) === TRUE) {
        header('location:manageStaff.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }
}
