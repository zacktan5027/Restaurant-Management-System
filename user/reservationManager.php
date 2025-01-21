<?php
session_start();
require_once "conn.php";

$res_id = $_POST['RestaurantID'];
$acc_id = $_SESSION['user']['id'];
$acc_name = $_SESSION['user']['name'];
$acc_email = $_SESSION['user']['email'];
$acc_phoneNumber = $_SESSION['user']['phoneNumber'];
$res_date = $_POST['ReservationDate'];
$res_time = $_POST['ReservationTime'];
$res_comment = $_POST['ReservationComment'];

$minimumNormalTime = date('H:i:s', strtotime('-1 hour -30minutes', strtotime($res_time)));
$maximumNormalTime = date('H:i:s', strtotime('+1 hour +30minutes', strtotime($res_time)));
$minimumFullTime = date('H:i:s', strtotime('-3 hour -30minutes', strtotime($res_time)));
$maximumFullTime = date('H:i:s', strtotime('+3 hour +30minutes', strtotime($res_time)));

if (isset($_POST['normal'])) {
    $res_pax = $_POST['ReservationPax'];

    $paxcheck = $conn->query("SELECT COUNT(ReservationPax) as total FROM reservation WHERE RestaurantID = " . $res_id . " AND ReservationType='Normal Reservation' AND ReservationDate='" . $res_date . "' AND ReservationTime >= CAST('" . $minimumNormalTime . "' AS time) AND ReservationTime <= CAST('" . $maximumNormalTime . "' AS time) GROUP BY ReservationPax");

    $normalTotal = $paxcheck->fetch_array();

    $checkTable = $conn->query("select table" . $res_pax . " from restaurant");
    $totalOfTable = $checkTable->fetch_array();

    if ($normalTotal['total'] < $totalOfTable['table' . $res_pax . '']) {
        $paxcheckWhole = $conn->query("SELECT COUNT(ReservationPax) as total FROM reservation WHERE RestaurantID = " . $res_id . " AND ReservationType='Whole Reservation' AND ReservationDate='" . $res_date . "' AND ReservationTime >= CAST('" . $minimumFullTime . "' AS time) AND ReservationTime <= CAST('" . $maximumFullTime . "' AS time) GROUP BY ReservationPax");
        $fullTotal = $paxcheckWhole->fetch_array();

        if ($fullTotal['total'] > 0) {
            echo "
            <script>
            alert('Sorry. There are whole reservation during this date. Please choose another date for a reservation.');
            location.assign('reservation.php?type=normal');
            </script>";
        } else {
            $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, AccountName, AccountEmail, AccountPhoneNumber, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '$acc_id','$acc_name','$acc_email','$acc_phoneNumber', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>alert('You have successfully make the reservation!');</script>";
                echo "<script>location.assign('reservation.php?type=normal');</script>";
            } else {
                echo "<script>alert('Failed to book! Something wrong.');</script>";
                echo "<script>location.assign('reservation.php?type=normal');</script>";
            }
        }
    } else {
        echo "<script>alert('Sorry. There are already maximum booking on this time. You can choose another date to make a reservation.');</script>";
        echo "<script>location.assign('reservation.php?type=normal');</script>";
    }

    // $status = "SELECT ReservationStatus, ReservationType, RestaurantID, ReservationDate FROM reservation WHERE ReservationStatus = 'Approved' AND ReservationType = 'Whole Reservation' AND RestaurantID = '$res_id' AND ReservationDate = '$res_date'";
    // $checkstat = $conn->query($status);


    // //For Restaurant 1 & Table 2
    // if ($res_id == '1001' && $res_pax == '2' && $paxcheck->num_rows < 3 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 1 & Table 4
    // else if ($res_id == '1001' && $res_pax == '4' && $paxcheck->num_rows < 3 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 1 & Table 8 
    // else if ($res_id == '1001' && $res_pax == '8' && $paxcheck->num_rows < 3 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // //For Restaurant 2 & Table 2
    // if ($res_id == '1002' && $res_pax == '2' && $paxcheck->num_rows < 2  && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 2 & Table 4
    // else if ($res_id == '1002' && $res_pax == '4' && $paxcheck->num_rows < 5 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 2 & Table 8 
    // else if ($res_id == '1002' && $res_pax == '8' && $paxcheck->num_rows < 2 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // //For Restaurant 3 & Table 2
    // if ($res_id == '1003' && $check->num_rows < 10 && $res_pax == '2' && $paxcheck->num_rows < 3 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 3 & Table 4
    // else if ($res_id == '1003' && $res_pax == '4' && $paxcheck->num_rows < 5 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 3 & Table 8 
    // else if ($res_id == '1003' && $res_pax == '8' && $paxcheck->num_rows < 2 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // //For Restaurant 4 & Table 2
    // if ($res_id == '1004' && $res_pax == '2' && $paxcheck->num_rows < 2 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 4 & Table 4
    // else if ($res_id == '1004' && $res_pax == '4' && $paxcheck->num_rows < 4 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // // For Restaurant 4 & Table 8 
    // else if ($res_id == '1004' && $res_pax == '8' && $paxcheck->num_rows < 3 && $checkstat->num_rows < 1) {
    //     $sql_insert = "INSERT INTO reservation ( RestaurantID, AccountID, ReservationDate, ReservationTime, ReservationType, ReservationPax, ReservationComment, ReservationStatus) VALUES ('$res_id', '1001', '$res_date', '$res_time', 'Normal Reservation', '$res_pax', '$res_comment' , 'Approved')";
    //     if (mysqli_query($conn, $sql_insert)) {

    //         echo "<script>alert('You have successfully make the reservation!');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     } else {
    //         echo "<script>alert('Failed to book! Something wrong.');</script>";
    //         echo "<script>location.assign('normalreservation.php');</script>";
    //     }
    // }

    // Error if there are whole reservation
    // else if ($checkstat->num_rows >= 1) {
    //     echo "<script>alert('Sorry. There are whole reservation during this date. Please choose another date for a reservation.');</script>";
    //     echo "<script>location.assign('normalreservation.php');</script>";
    // } else
    //     echo "<script>alert('Sorry. There are already maximum booking on this date. You can choose another date to make a reservation.');</script>";
    //echo "<script>location.assign('normalreservation.php');</script>";
}

if (isset($_POST['full'])) {
    $paxcheck = $conn->query("SELECT COUNT(ReservationPax) as total FROM reservation WHERE RestaurantID = " . $res_id . " AND ReservationType='Normal Reservation' AND ReservationDate='" . $res_date . "' AND ReservationTime >= CAST('" . $minimumNormalTime . "' AS time) AND ReservationTime <= CAST('" . $maximumFullTime . "' AS time) GROUP BY ReservationPax");
    $normalTotal = $paxcheck->fetch_array();

    $sql = "SELECT COUNT(ReservationPax) as total FROM reservation WHERE RestaurantID = " . $res_id . " AND ReservationType='Whole Reservation' AND ReservationDate='" . $res_date . "' AND ReservationTime >= CAST('" . $minimumFullTime . "' AS time) AND ReservationTime <= CAST('" . $maximumFullTime . "' AS time) GROUP BY ReservationPax";
    $check = $conn->query($sql);
    $fullCheck = $check->fetch_array();

    if ($normalTotal['total'] > 0 || $fullCheck['total'] > 0) {
        echo "<script>alert('Failed to book! There are reservation in this time');</script>";
        echo "<script>location.assign('reservation.php');</script>";
    } else {
        $sql2 = "INSERT INTO reservation ( RestaurantID, AccountID, AccountName, AccountEmail, AccountPhoneNumber, ReservationDate, ReservationTime, ReservationType, ReservationComment, ReservationStatus) VALUES ('$res_id', '$acc_id','$acc_name','$acc_email','$acc_phoneNumber', '$res_date', '$res_time', 'Whole Reservation', '$res_comment', 'Pending')";
        if (mysqli_query($conn, $sql2)) {
            echo "<script>alert('You have to wait for the confirmation');</script>";
            echo "<script>location.assign('reservation.php');</script>";
        } else
            echo "<script>alert('Something went wrong');</script>";
        echo "<script>location.assign('reservation.php?type=full');</script>";
    }
}
