<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Dish</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugins Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugins Close -->
</head>

<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 9999;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        padding: 20px;
        margin: auto;
        /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 70%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.4s;
        animation: animatezoom 0.4s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }
</style>


<body>
    <!-- Header Start -->

    <?php include('header.php'); ?>

    <!-- Header Close -->

    <section class="slider-hero hero-slider  hero-style-1  ">
        <section class="section-header bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="text-capitalize mb-4 font-lg text-white">Dish</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div style="margin: auto;width:80%">
                <select id="catList" class="btn btn-default">
                    <option value="0">All Category</option>
                    <?php
                    $sql = "select * from category";
                    $catquery = $conn->query($sql);
                    while ($catrow = $catquery->fetch_array()) {
                        $catid = isset($_GET['category']) ? $_GET['category'] : 0;
                        $selected = ($catid == $catrow['CategoryID']) ? " selected" : "";
                        echo "<option $selected value=" . $catrow['CategoryID'] . ">" . $catrow['CategoryName'] . "</option>";
                    }
                    ?>
                </select>
                <select id="conList" class="btn btn-default">
                    <option value="0">All condition</option>
                    <?php
                    $select1 = "";
                    $select2 = "";
                    if (isset($_GET['condition'])) {
                        if ($_GET['condition'] == 1)
                            $select1 = "selected";
                        else
                            $select2 = "selected";
                    }
                    ?>
                    <option <?= $select1 ?> value="1">Active</option>
                    <option <?= $select2 ?> value="2">Deactive</option>
                </select>
                <button class="btn btn-main float-right" onclick="document.getElementById('addproduct').style.display='block'"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Product</button>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-center table-cart">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 350px;">product name</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">DishPerPax</th>
                                        <th scope="col" style="width: 300px;">Dish Description</th>
                                        <th scope="col">Dish Spiciness</th>
                                        <th scope="col" style="width: 350px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $where = "";
                                    if (isset($_GET['category'])) {
                                        $catid = $_GET['category'];
                                        if ($_GET['category'] == 0)
                                            $where = "";
                                        else
                                            $where = " WHERE dish.CategoryID = $catid";
                                    }
                                    if (isset($_GET['condition'])) {
                                        $active = 1;
                                        if ($_GET['condition'] == 2)
                                            $active = 0;
                                        $where = "WHERE dish.active = " . $active . "";
                                    }
                                    if (isset($_GET['category']) && isset($_GET['condition'])) {
                                        $catid = $_GET['category'];
                                        $active = 1;
                                        if ($_GET['condition'] == 2)
                                            $active = 0;

                                        if ($catid == 0) {
                                            $where = "WHERE dish.active = " . $active . "";
                                        } else if ($_GET['condition'] == 0) {
                                            $where = " WHERE dish.CategoryID = $catid ";
                                        } else if ($catid == 0 && $_GET['condtion'] == 0) {
                                            $where = "";
                                        } else {
                                            $where = " WHERE dish.CategoryID = $catid AND dish.active = " . $active . "";
                                        }
                                    }

                                    $sql = "select * from dish natural join category $where order by CategoryID asc, DishName asc";

                                    $res_q = $conn->query($sql);
                                    $dishes = [];
                                    $totalPrice = 0;
                                    if (mysqli_num_rows($res_q) > 0) {
                                        while ($res = $res_q->fetch_array()) {
                                    ?>
                                            <tr>
                                                <td class="text-left">
                                                    <img src="../upload/<?= $res['DishPhoto'] ?>" alt="" class="img-fluid w-25 mr-3">
                                                    <?= $res['DishName'] ?>
                                                </td>
                                                <td>RM<?= sprintf('%0.2f', $res["DishPrice"]) ?></td>
                                                <td><?= $res['CategoryName'] ?></td>
                                                <td><?= $res['DishPerPax'] ?></td>
                                                <td style="height: 150px;">
                                                    <?php if (strlen($res['DishDescription']) > 80)
                                                        echo substr($res['DishDescription'], 0, 80) . "...";
                                                    else
                                                        echo $res['DishDescription'];
                                                    ?>
                                                </td>
                                                <td><?= $res['DishSpiciness'] ?></td>
                                                <td style="text-align:center"> <button class="btn btn-main" onclick="document.getElementById('editDish<?php echo $res['DishID']; ?>').style.display='block'">Edit</button>

                                                    <?php
                                                    if ($res['active']) {
                                                    ?>
                                                        <button class="btn btn-main" onclick="document.getElementById('deactiveDish<?php echo $res['DishID']; ?>').style.display='block'">Deactive</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="document.getElementById('deactiveDish<?php echo $res['DishID']; ?>').style.display='block'">Active</button>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php include('dish_modal.php'); ?>
                                        <?php
                                        }
                                    } else {
                                        ?>

                                        <td colspan="7">
                                            <h2>There is no result</h2>
                                        </td>
                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <?php include('addDish_modal.php'); ?>
    </section>
    <!--  Banner End -->



    </section>
    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>

<script type="text/javascript">
    $(document).ready(function() {

        $("#catList").on('change', function() {
            localStorage.setItem('category', 1);
            if (localStorage.getItem('condition') == 1) {
                if ($(this).val() == 0) {
                    window.location = 'manageDish.php?condition=' + localStorage.getItem('con');
                    localStorage.setItem('category', 0);
                    localStorage.setItem('cat', 0);
                } else {
                    localStorage.setItem('cat', $(this).val());
                    window.location = 'manageDish.php?condition=' + localStorage.getItem('con') + '&category=' + $(this).val();
                }
            } else {
                if ($(this).val() == 0) {
                    window.location = 'manageDish.php';
                    localStorage.setItem('category', 0);
                    localStorage.setItem('cat', 0);
                } else {
                    localStorage.setItem('cat', $(this).val());
                    window.location = '?category=' + $(this).val();
                }
            }
        });

        $("#conList").on('change', function() {
            localStorage.setItem('condition', 1);
            if (localStorage.getItem('category') == 1) {
                if ($(this).val() == 0) {
                    window.location = 'manageDish.php?category=' + localStorage.getItem('cat');
                    localStorage.setItem('condition', 0);
                    localStorage.setItem('con', 0);
                } else {
                    localStorage.setItem('con', $(this).val());
                    window.location = 'manageDish.php?category=' + localStorage.getItem('cat') + '&condition=' + $(this).val();
                }
            } else {
                if ($(this).val() == 0) {
                    window.location = 'manageDish.php';
                    localStorage.setItem('condition', 0);
                    localStorage.setItem('con', 0);
                } else {
                    localStorage.setItem('con', $(this).val());
                    window.location = '?condition=' + $(this).val();
                }
            }
        });

        $(".addPrice").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                //display error message
                $(".addPrice_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

        $(".editPrice").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                //display error message
                $(".editPrice_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

        $(".editPax").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $(".editPax_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

        $(".addPax").keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $(".addPax_error_msg").html("Number only").show().fadeOut("slow");
                return false;
            }
        });

    });
</script>

</html>