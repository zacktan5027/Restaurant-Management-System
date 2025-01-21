<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Restaurant</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Restaurant</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div style="margin: auto;width:80%">
                <div style="text-align: right;">
                    <button class="btn btn-main" onclick="document.getElementById('addres').style.display='block'"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp; Restaurant</button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-center table-cart">
                                <thead>
                                    <tr>
                                        <th style="width: 150px;">Photo</th>
                                        <th>Restaurant Name</th>
                                        <th>Restaurant Address 1</th>
                                        <th style="width: 200px;">Restaurant Address 2</th>
                                        <th>Poscode</th>
                                        <th>District</th>
                                        <th>State</th>
                                        <th style="width: 350px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $where = "";
                                    if (isset($_GET['restaurant'])) {
                                        $catid = $_GET['restaurant'];
                                        $where = " WHERE restaurant.RestaurantState = $catid";
                                    }
                                    $sql = "select * from restaurant $where order by restaurant.RestaurantState asc, RestaurantName asc";
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><a href="<?php if (empty($row['RestaurantPhoto'])) {
                                                                echo "upload/noimage.jpg";
                                                            } else {
                                                                echo "../upload/" . $row['RestaurantPhoto'];
                                                            } ?>"><img src="<?php if (empty($row['RestaurantPhoto'])) {
                                                                                echo "../upload/noimage.jpg";
                                                                            } else {
                                                                                echo "../upload/" . $row['RestaurantPhoto'];
                                                                            } ?>" height="30px" width="40px"></a></td>
                                            <td><?php echo $row['RestaurantName']; ?></td>
                                            <td><?php echo $row['RestaurantAddress1']; ?></td>
                                            <td><?php echo $row['RestaurantAddress2']; ?></td>
                                            <td><?php echo $row['RestaurantPostcode']; ?></td>
                                            <td><?php echo $row['RestaurantCity']; ?></td>
                                            <td><?php echo $row['RestaurantState']; ?></td>
                                            <td>
                                                <button class="btn btn-main" onclick="document.getElementById('editres<?php echo $row['RestaurantID']; ?>').style.display='block'">Edit</button>
                                                <button class="btn btn-main" onclick="document.getElementById('deleteres<?php echo $row['RestaurantID']; ?>').style.display='block'">Delete</button>
                                                <?php include('restaurant_modal.php'); ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include('addRestaurant_modal.php'); ?>
    </section>
    <!--  Banner End -->



    </section>
    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>


<script type="text/javascript">
    $(document).ready(function() {
        $("#conList").on('change', function() {

            if ($(this).val() == 0) {
                window.location = 'manageDishCategory.php';
            } else {
                localStorage.setItem('con', $(this).val());
                window.location = '?condition=' + $(this).val();
            }

        });
    });
</script>

</html>