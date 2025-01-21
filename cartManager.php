<?php
require_once "include/cart.inc.php";
require_once "include/dbh.inc.php";

if (isset($_POST["quantities"]))
    $quantity = $_POST["quantities"];
if (isset($_POST['quantity']))
    $quantity = $_POST['quantity'];

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            addToCart($conn, $_POST["id"], $quantity);
            header("location:menu.php#" . $_POST["id"] . "");
            break;
        case "change":
            if ($_POST["quantities"] > 0 && $_POST["quantities"] != "") {
                change($_POST["id"], $quantity);
                header("location:cart.php#main");
            } else
                echo ("<script>
                myFunction();
                function myFunction() {
                var txt;
                var r = confirm('Do you want to remove this item from your cart?');
                if (r == true) {
                    window.location.href='cartManager.php?action=remove&id=" . $_POST["id"] . "&location=cart';
                } else {
                    window.location.href='cart.php#main';
                }
                }
                 </script>");
            break;
        case "add1":
            addOneToCart($_GET["id"]);
            header("location:cart.php#main");
            break;
        case "minus1":
            if (minusOneFromCart($_GET["id"]))
                header("location:cart.php#main");
            else
                echo ("<script>
                myFunction();
                function myFunction() {
                var txt;
                var r = confirm('Do you want to remove this item from your cart?');
                if (r == true) {
                    window.location.href='cartManager.php?action=remove&id=" . $_GET["id"] . "&location=cart';
                } else {
                    window.location.href='cart.php#main';
                }
                }
                </script>");
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($v["id"] == $_GET["id"])
                        if ($k == 0)
                            array_splice($_SESSION["cart_item"], 0, 1);
                        else if ($k == count($_SESSION["cart_item"]))
                            array_pop($_SESSION["cart_item"]);
                        else
                            array_splice($_SESSION["cart_item"], $k, 1);
                }
                if (empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
                if (isset($_GET['location'])) {
                    if ($_GET['location'] == "cart") {
                        header("location:cart.php");
                    }
                } else
                    header("location:cart.php");
            }

            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            header("location:cart.php");
            break;
    }
}
