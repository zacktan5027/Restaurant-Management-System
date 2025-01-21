<?php
require_once('include/dbh.inc.php');

if (isset($_POST['register'])) {

    $AccountUsername = $_POST['AccountUsername'];
    $AccountPassword = $_POST['AccountPassword'];
    $AccountPassword2 = $_POST['AccountPassword2'];
    $AccountEmail = $_POST['AccountEmail'];
    $AccountName = $_POST['AccountName'];
    $AccountPhoneNumber = $_POST['AccountPhoneNumber'];
    if ($_POST['AccountAddress1'] != "") {
        if (trim($_POST['AccountAddress1']) == "" || trim($_POST['AccountAddress2']) == "" || trim($_POST['AccountPostcode']) == "" || trim($_POST['AccountCity']) == "" || trim($_POST['AccountState']) == "")
            echo "<script>
            window.alert('You cannot put only spaces in address field');
            window.location.href='register.php'
            </script>";
        $AccountAddress1 = $_POST['AccountAddress1'];
        $AccountAddress2 = $_POST['AccountAddress2'];
        $AccountPostcode = $_POST['AccountPostcode'];
        $AccountCity = $_POST['AccountCity'];
        $AccountState = $_POST['AccountState'];
    } else {
        $AccountAddress1 = null;
        $AccountAddress2 = null;
        $AccountPostcode = null;
        $AccountCity = null;
        $AccountState = null;
    }
    $SecurityQuestion = $_POST['SecurityQuestion'];
    $SecurityAnswer = $_POST['SecurityAnswer'];
    $vkey = md5(time() . $AccountUsername);

    if ($AccountPassword !== $AccountPassword2) {
        echo "<script>
            window.alert('Password is not same');
            window.location.href='register.php'
            </script>";
    }

    $checkUsername = "SELECT * FROM account WHERE AccountUsername='" . $AccountUsername . "'";
    $resultUsername = $conn->query($checkUsername);

    if ($resultUsername->num_rows > 0) {
        echo "<script>
            window.alert('Username is taken, please use another username');
            window.location.href='register.php'
            </script>";
    } else {
        $checkEmail = "SELECT * FROM account WHERE AccountEmail='" . $AccountEmail . "'";
        $resultEmail = $conn->query($checkEmail);

        if ($resultEmail->num_rows > 0) {

            echo "<script>
            window.alert('Email is taken, please use another email');
            window.location.href='register.php'
            </script>";
        } else {
            $AccountPassword = password_hash($AccountPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `account`(`AccountUsername`, `AccountPassword`, `AccountEmail`, `AccountName`, `AccountPhoneNumber`, `AccountAddress1`, `AccountAddress2`, `AccountPostcode`, `AccountCity`, `AccountState`, `SecurityQuestion`, `SecurityAnswer`, `VerificationKey`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('ssssssssssiss', $AccountUsername, $AccountPassword, $AccountEmail, $AccountName, $AccountPhoneNumber, $AccountAddress1, $AccountAddress2, $AccountPostcode, $AccountCity, $AccountState, $SecurityQuestion, $SecurityAnswer, $vkey);
                $stmt->execute();
                $stmt->close();

                ini_set("smtp", "smtp.server.com");
                $to = "$AccountEmail";
                $subject = "Restaurant Management System - Verification";
                $message = "Hi, " . $AccountName . ". Click <a href='http://localhost/RMS/verify.php?vkey=" . $vkey . "&email=" . $AccountEmail . "'>here</a> to verify your account.";
                $headers  = 'From: adhe.ansa@gmail.com';
                $headers .= "MIME-Version:1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to, $subject, $message, $headers);

                echo ("<script LANGUAGE='JavaScript'>
								    window.alert('Successfully register, an email is sent to $AccountEmail ,please verify your account.');
								    window.location.href='index.php';
								    </script>");
            } else {
                echo "<script>
                window.alert('Something went wrong');
                window.location.href='register.php'
                </script>";
            }
        }
    }
}
