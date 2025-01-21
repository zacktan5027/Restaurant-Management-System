<?php
session_start();
function payment($conn, $id, $name, $email, $state, $destination, $phoneNumber, $note, $method, $grandTotal)
{
    $restaurantID = 0;
    $orderID = 0;
    $total = 0;
    $saving = 0;
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $currentDate = date('Y-m-d');
    $currentTime = date("h:i:s");
    $deliveryStatus = "Done Prepared";

    $sql = "SELECT RestaurantID FROM restaurant WHERE RestaurantState = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $state);
    $stmt->execute();
    $stmt->bind_result($restaurantID);
    $stmt->fetch();
    $stmt->close();

    if ($restaurantID == null) {
        echo ("<script>
                window.alert('Sorry, delivery is not available in your area.');
                window.location.href='index.php';
                </script>");
    }
    if ($method == "ewallet") {

        $sql = "INSERT INTO orders(`AccountID`, `RestaurantID`,`AccountName`,`AccountPhoneNumber`,`AccountEmail`, `OrderDate`, `OrderTime`, `TotalCost`, `PaymentMethod`, `Destination`, `Notes`, `DeliveryStatus`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisssssdssss', $id, $restaurantID, $name, $phoneNumber, $email, $currentDate, $currentTime, $grandTotal, $method, $destination, $note, $deliveryStatus);
        if (!$stmt->execute())
            echo $stmt->error;
        $stmt->close();

        $sql = "SELECT OrderID FROM orders WHERE AccountID = ? AND OrderDate = ? AND OrderTime = ? AND DeliveryStatus = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isss', $id, $currentDate, $currentTime, $deliveryStatus);
        $stmt->execute();
        $stmt->bind_result($orderID);
        $stmt->fetch();
        $stmt->close();

        foreach ($_SESSION["cart_item"] as $i => $value) {
            $sql = "INSERT INTO orderdetail(`OrderID`, `DishID`, `Quantity`) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $orderID, $value["id"], $value["quantity"]);
            $stmt->execute();
            $stmt->close();
        }

        // $sql = "SELECT AmountEwallet FROM account WHERE AccountID = ?";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param('i', $id);
        // $stmt->execute();
        // $stmt->bind_result($saving);
        // $stmt->fetch();
        // $stmt->close();

        $sql = "select * from account WHERE AccountID ='$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_array();
        $saving = $row['AmountEwallet'];

        if ($saving < $grandTotal) {
            echo ("<script LANGUAGE='JavaScript'>
      window.alert('Your E-Wallet has insufficient amount for this order');
      window.location.href='payment.php';
      </script>");
        }
        $total = $saving - $grandTotal;

        $total = sprintf('%0.2f', $total);

        $sql = "UPDATE account SET AmountEwallet=? WHERE AccountID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('di', $total, $id);
        $stmt->execute();

        echo "<script>location.assign('sendInvoice.php?id=" . $orderID . "');</script>";
    } else {
        $sql = "INSERT INTO `orders`(`AccountID`, `AccountName`, `AccountPhoneNumber`, `AccountEmail`, `RestaurantID`, `OrderDate`, `OrderTime`, `TotalCost`, `PaymentMethod`, `Destination`, `Notes`, `DeliveryStatus`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isssissdssss', $id, $name, $phoneNumber, $email, $restaurantID, $currentDate, $currentTime, $grandTotal, $method, $destination, $note, $deliveryStatus);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT OrderID FROM orders WHERE AccountID = ? AND OrderDate = ? AND OrderTime = ? AND DeliveryStatus = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isss', $id, $currentDate, $currentTime, $deliveryStatus);
        $stmt->execute();
        $stmt->bind_result($orderID);
        $stmt->fetch();
        $stmt->close();

        foreach ($_SESSION["cart_item"] as $i => $value) {
            $sql = "INSERT INTO orderdetail(`OrderID`, `DishID`, `Quantity`) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $orderID, $value["id"], $value["quantity"]);
            $stmt->execute();
            $stmt->close();
        }
    }
    unset($_SESSION['cart_item']);
    unset($_SESSION['totalPrice']);

    return $orderID;
}

function topUp($conn, $id, $amount)
{
    $sql = "select * from account WHERE AccountID ='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_array();
    $saving = $row['AmountEwallet'];

    $total = $saving + $amount;

    $total = sprintf('%0.2f', $total);

    $sql = "UPDATE account SET AmountEwallet=? WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('di', $total, $id);
    $stmt->execute();
}
