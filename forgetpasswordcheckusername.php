<?php
session_start();
require_once "conn.php";

$AccountUsername = $_POST['AccountUsername'];
$AccountEmail = $_POST['AccountEmail'];


if (mysqli_connect_error()) {
    die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
} else {
    $stmt = $conn->prepare('SELECT AccountEmail From account Where AccountEmail = ?');
    $stmt->bind_param("s", $AccountEmail);
    $stmt->execute();
    $stmt->bind_result($AccountEmail);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum != 0) {
        $stmt = $conn->prepare('SELECT AccountUsername From account Where AccountUsername = ?');
        $stmt->bind_param("s", $AccountUsername);
        $stmt->execute();
        $stmt->bind_result($AccountUsername);
        $stmt->store_result();
        $rnum2 = $stmt->num_rows;
        if ($rnum2 != 0) {
            $_SESSION['AccountUsername'] = $AccountUsername;
            echo ("<script LANGUAGE='JavaScript'>
								    window.alert('Succesfully found, please answer the security question.');
								    window.location.href='securityquestion.php?found=1';
                                    </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'>
							window.alert('Username not exist, please use another one.');
							window.location.href='forgetpasswordindex.php';
							</script>");
        }
    } else {
        echo ("<script LANGUAGE='JavaScript'>
					window.alert('Email not exist, please use another one.');
					window.location.href='forgetpasswordindex.php';
					</script>");
    }
    $stmt->close();
    $conn->close();
}
