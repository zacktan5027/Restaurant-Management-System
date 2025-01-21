<?php

session_start();

require_once "conn.php";

if (trim($_POST['AccountName']) == "")
    echo "<script>
            window.alert('You cannot put only spaces in name field');
            window.location.href='register.php'
            </script>";

if (trim($_POST['AccountAddress1']) == "" || trim($_POST['AccountAddress2']) == "" || trim($_POST['AccountPostcode']) == "" || trim($_POST['AccountCity']) == "" || trim($_POST['AccountState']) == "")
    echo "<script>
            window.alert('You cannot put only spaces in address field');
            window.location.href='register.php'
            </script>";

$AccountName = $_POST['AccountName'];
$AccountPhoneNumber = $_POST['AccountPhoneNumber'];
$AccountAddress1 = $_POST['AccountAddress1'];
$AccountAddress2 = $_POST['AccountAddress2'];
$AccountPostcode = $_POST['AccountPostcode'];
$AccountCity = $_POST['AccountCity'];
$AccountState = $_POST['AccountState'];
$id = $_SESSION['user']['id'];


$stmt = $conn->prepare('UPDATE `account` SET `AccountName`=?,`AccountPhoneNumber`=?,`AccountAddress1`=?,`AccountAddress2`=?,`AccountPostcode`=?,`AccountCity`=?,`AccountState`=? WHERE AccountID = ' . $id . '');
$stmt->bind_param('sssssss', $AccountName, $AccountPhoneNumber, $AccountAddress1, $AccountAddress2, $AccountPostcode, $AccountCity, $AccountState);
$stmt->execute();

$_SESSION['user']['name'] = $AccountName;
$_SESSION['user']['phoneNumber'] = $AccountPhoneNumber;
$_SESSION['user']['address1'] = $AccountAddress1;
$_SESSION['user']['address2'] = $AccountAddress2;
$_SESSION['user']['postcode'] = $AccountPostcode;
$_SESSION['user']['city'] = $AccountCity;
$_SESSION['user']['state'] = $AccountState;

echo ("<script LANGUAGE='JavaScript'>
								    window.alert('Succesfully updated your profile.');
								    window.location.href='profile.php';
								    </script>");
