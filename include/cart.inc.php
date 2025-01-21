<?php
session_start();

function getDishes($conn)
{
    $sql = "SELECT * FROM dish";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $productByCode = mysqli_stmt_get_result($stmt);
    $items_array[] = null;

    while ($row = mysqli_fetch_assoc($productByCode)) {
        $item_array[] = array(
            'id'     => $row["DishID"],
            'name'     => $row["DishName"],
            'price'    => $row["DishPrice"]
        );
    }
    return $item_array;
}


function addToCart($conn, $id, $quantity)
{
    if (empty($_SESSION["cart_item"])) {

        $row = getDish($conn, $id);

        $item_array = array(
            'id'     => $row["DishID"],
            'name'     => $row["DishName"],
            'quantity' => $quantity,
            'price'    => $row["DishPrice"]
        );
        $_SESSION["cart_item"][0] = $item_array;
    } else {
        $row = getDish($conn, $id);
        $item_array = array(
            'id'     => $row["DishID"],
            'name'     => $row["DishName"],
            'quantity' => $quantity,
            'price'    => $row["DishPrice"]
        );
        $size = count($_SESSION["cart_item"]) + 1;
        $cart = array_column($_SESSION["cart_item"], "id");
        if (!in_array($id, $cart)) {
            $_SESSION["cart_item"][$size - 1] = $item_array;
        } else {
            foreach ($_SESSION["cart_item"] as $i => &$value) {
                if ($value["id"] == $id)
                    $value["quantity"] += $quantity;
            }
        }
    }
}

function change($id, $quantity)
{
    foreach ($_SESSION["cart_item"] as $i => &$value) {
        if ($value["id"] == $id)
            $value["quantity"] = $quantity;
    }
}

function addOneToCart($id)
{
    foreach ($_SESSION["cart_item"] as $i => &$value) {
        if ($value["id"] == $id)
            $value["quantity"] += 1;
    }
}

function minusOneFromCart($id)
{
    foreach ($_SESSION["cart_item"] as $i => &$value) {
        if ($value["id"] == $id)
            if ($value["quantity"] <= 1)
                return false;
            else {
                $value["quantity"] -= 1;
                return true;
            }
    }
}

function getDish($conn, $id)
{
    $sql = "SELECT * FROM dish WHERE DishID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $productByCode = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($productByCode);
    return $row;
}
