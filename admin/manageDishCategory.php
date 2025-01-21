<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Dish Category</title>

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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Dish Category</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
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
                <button class="btn btn-main float-right" onclick="document.getElementById('addcategory').style.display='block'"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Category</button>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-center table-cart">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $where = "";
                                    if (isset($_GET['condition'])) {
                                        $active = 1;
                                        if ($_GET['condition'] == 2)
                                            $active = 0;
                                        $where = "WHERE active = " . $active . "";
                                    }
                                    $sql = "select * from category $where order by categoryid asc";
                                    $query = $conn->query($sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = $query->fetch_array()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['CategoryName']; ?></td>
                                                <td>
                                                    <button class="btn btn-main" onclick="document.getElementById('editcategory<?php echo $row['CategoryID']; ?>').style.display='block'">Edit</button>
                                                    <?php
                                                    if ($row['activeCategory']) {
                                                    ?>
                                                        <button class="btn btn-main" onclick="document.getElementById('deactivecategory<?php echo $row['CategoryID']; ?>').style.display='block'">Deactive</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-dark" onclick="document.getElementById('deactivecategory<?php echo $row['CategoryID']; ?>').style.display='block'">Active</button>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php include('category_modal.php'); ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <td colspan="2">
                                            <h2>There is no result</h2>
                                        </td>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include('addCategory_modal.php'); ?>
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