<?php
require_once('include/dbh.inc.php');
session_start();

if (isset($_POST['login'])) {

    $AccountUsername = $_POST['AccountUsername'];
    $AccountPassword = $_POST['AccountPassword'];

    $checkUsername = 'SELECT * FROM account WHERE AccountUsername = ? OR AccountEmail=?';
    $stmt = $conn->prepare($checkUsername);
    $stmt->bind_param('ss', $AccountUsername, $AccountUsername);
    $stmt->execute();
    $user = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($user)) {
        if ($row['Verification'] == 1) {
            if (password_verify($AccountPassword, $row['AccountPassword'])) {
                $_SESSION["user"] = array(
                    'id' => $row['AccountID'],
                    'name' => $row['AccountName'],
                    'email' => $row['AccountEmail'],
                    'phoneNumber' => $row['AccountPhoneNumber'],
                    'address1' => $row['AccountAddress1'],
                    'address2' => $row['AccountAddress2'],
                    'postcode' => $row['AccountPostcode'],
                    'city' => $row['AccountCity'],
                    'state' => $row['AccountState'],
                    'ewallet' => $row['AmountEwallet']
                );
                echo ("<script>
                window.location.href='user/index.php';
                </script>");
            } else {
                echo ("<script>
                window.alert('Wrong password user.');
                window.location.href='index.php';
                </script>");
            }
        } else {
            echo ("<script>
            window.alert('Please verify your account first.');
            window.location.href='index.php';
            </script>");
        }
    } else {
        $checkStaff = 'SELECT * FROM staff WHERE StaffUsername = ? OR StaffEmail=?';
        $stmt = $conn->prepare($checkStaff);
        $stmt->bind_param('ss', $AccountUsername, $AccountUsername);
        $stmt->execute();
        $user = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($user)) {
            if ($row['StaffPosition'] == "Admin") {
                if (password_verify($AccountPassword, $row['StaffPassword'])) {
                    $_SESSION["user"] = array(
                        'id' => $row['StaffID'],
                        'admin' => true,
                    );
                    echo ("<script>
                window.location.href='admin/index.php';
                </script>");
                } else {
                    echo ("<script>
                window.alert('Wrong password.');
                window.location.href='index.php';
                </script>");
                }
            } else if ($row['StaffPosition'] == "Manager") {
                if ($row['active'] == 1) {
                    if (password_verify($AccountPassword, $row['StaffPassword'])) {
                        $_SESSION["user"] = array(
                            'id' => $row['StaffID'],
                            'resid' => $row['RestaurantID'],
                            'manager' => true,
                        );
                        echo ("<script>
                window.location.href='manager/index.php';
                </script>");
                    } else {
                        echo ("<script>
                window.alert('Wrong password.');
                window.location.href='index.php';
                </script>");
                    }
                } else {
                    echo ("<script>
                window.alert('Your account has been deactivated please contact the management department.');
                window.location.href='index.php';
                </script>");
                }
            }
        } else {
            echo ("<script>
                window.alert('Wrong account.');
                window.location.href='index.php';
                </script>");
        }
    }
}
