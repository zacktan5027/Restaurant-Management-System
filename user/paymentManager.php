<?php
require_once "../conn.php";
require_once "../include/payment.inc.php";

$id = $_POST['AccountID'];

if (isset($_POST['payment'])) {
    $name = $_POST['AccountName'];
    $email = $_POST['AccountEmail'];
    $destination = $_POST['AccountAddress1'] . "," .
        $_POST['AccountAddress2'] . "," .
        $_POST['AccountPostcode'] . "," .
        $_POST['AccountCity'] . "," .
        $_POST['AccountState'];
    $state = $_POST['AccountState'];
    $phoneNumber = $_POST['AccountPhoneNumber'];
    $note = $_POST['note'];
    $method = $_POST['method'];
    $grandTotal = $_POST['total'];

    if ($id == 0) {
        if (isset($_POST['payment'])) {
            $orderID = payment($conn, $id, $name, $email, $state, $destination, $phoneNumber, $note, $method, $grandTotal);
            echo "<script>location.assign('sendInvoice.php?id=" . $orderID . "');</script>";
        }
    } else {
        if (isset($_POST['payment'])) {
            $orderID = payment($conn, $id, $name, $email, $state, $destination, $phoneNumber, $note, $method, $grandTotal);
            echo "<script>location.assign('sendInvoice.php?id=" . $orderID . "');</script>";
        }
    }
} else if (isset($_POST['topup'])) {
    topUp($conn, $id, $_POST['total']);
    echo ("<script>
                window.location.href='ewallet.php';
                </script>");
} else {
    echo ("<script>
                window.location.href='index.php';
                </script>");
}
