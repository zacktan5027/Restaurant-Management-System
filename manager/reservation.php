<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Reservation</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Plugin Start -->

    <?php include('plugins.php'); ?>

    <!-- Plugin Close -->
</head>


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
                            <h1 class="text-capitalize mb-4 font-lg text-white">Reservation</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div style="margin: auto;width:85%">
                <?php
                $sql = "SELECT * FROM reservation WHERE RestaurantID = " . $_SESSION['user']['resid'] . " AND ReservationStatus = 'Pending'";
                //$sql ="SELECT * FROM reservation WHERE RestaurantID = $res_id AND ReservationStatus = 'Pending'";
                $res = $conn->query($sql);

                if ($res->num_rows > 0) {
                ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table text-center table-cart">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th style="width: 250px;">Customer Phone Number</th>
                                            <th style="width: 150px;">Date</th>
                                            <th>Time</th>
                                            <th style="width: 350px;">Comment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $res->fetch_assoc()) {
                                            $res_id = $row['ReservationID'];
                                            $acc_name = $row['AccountName'];
                                            $acc_email = $row['AccountEmail'];
                                            $acc_phoneNumber = $row['AccountPhoneNumber'];
                                            $res_date = $row['ReservationDate'];
                                            $res_time = $row['ReservationTime'];
                                            $res_comment = $row['ReservationComment'];
                                            $res_status = $row['ReservationStatus'];

                                            //$sql1 = $db->query("SELECT * FROM equipment WHERE item_id = '$itemid'");
                                            //$row1 = $sql1->fetch_assoc();

                                        ?>
                                            <tr>
                                                <td><?php echo $acc_name; ?></td>
                                                <td><?php echo $acc_email; ?></td>
                                                <td><?php echo $acc_phoneNumber; ?></td>
                                                <td><?php echo $res_date; ?></td>
                                                <td><?php echo $res_time; ?></td>
                                                <td><?php echo $res_comment; ?></td>
                                                <form method="post" action="reservationManager.php">
                                                    <td>
                                                        <select name="status" required>
                                                            <option value=""><?php echo $res_status; ?></option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Not Approved</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="reservationManager.php">
                                                            <input type="hidden" name="ReservationID" value="<?php echo $res_id; ?>">
                                                            <input type="hidden" name="customerName" value="<?= $acc_name ?>">
                                                            <input type="hidden" name="customerEmail" value="<?= $acc_email ?>">
                                                            <input type="hidden" name="date" value="<?= $res_date ?>">
                                                            <input type="hidden" name="time" value="<?= $res_time ?>">
                                                            <input class="btn btn-main" type="submit" name="update" value="Update" onclick='return show_confirm();'>
                                                        </form>
                                                    </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <center>
                                            <h1>There are no reservation to be approve right now.</h1>
                                        </center>
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
    </section>
    <!--  Banner End -->

    <!--Footer start -->

    <?php include('footer.php'); ?>

    <!-- Footer  End -->

</body>
<script type="text/javascript">
    function show_confirm() {
        return confirm("Are you sure want to Update");
    }
</script>

</html>